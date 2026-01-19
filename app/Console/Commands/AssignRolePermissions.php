<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssignRolePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:assign-to-roles
                            {--force : Forzar la asignación sin confirmación}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asigna permisos específicos a cada rol según la lógica de negocio de la clínica';

    /**
     * Matriz de permisos por rol
     */
    private const ROLE_PERMISSIONS = [
        'cliente' => [
            // Reservas (solo lectura de las propias)
            'ViewAny:Reserva',
            'View:Reserva',
            // Reseñas (CRUD de las propias)
            'ViewAny:Resena',
            'View:Resena',
            'Create:Resena',
            'Update:Resena',
            'Delete:Resena',
            // Página y Widgets
            'View:MiPerfil',
            'View:ClienteStatsWidget',
            'View:ProximasCitasWidget',
        ],
        'profesional' => [
            // BloqueHorarios (CRUD completo de los propios)
            'ViewAny:BloqueHorario',
            'View:BloqueHorario',
            'Create:BloqueHorario',
            'Update:BloqueHorario',
            'Delete:BloqueHorario',
            // Reservas (ver y actualizar)
            'ViewAny:Reserva',
            'View:Reserva',
            'Update:Reserva',
            // Tratamientos (solo lectura)
            'ViewAny:Tratamiento',
            'View:Tratamiento',
            // Reseñas (solo lectura)
            'ViewAny:Resena',
            'View:Resena',
            // Página y Widgets
            'View:MiPerfil',
            'View:ProfesionalStatsWidget',
            'View:ProximasCitasWidget',
        ],
        'recepcionista' => [
            // Reservas (CRUD completo)
            'ViewAny:Reserva',
            'View:Reserva',
            'Create:Reserva',
            'Update:Reserva',
            'Delete:Reserva',
            // BloqueHorarios (CRUD completo)
            'ViewAny:BloqueHorario',
            'View:BloqueHorario',
            'Create:BloqueHorario',
            'Update:BloqueHorario',
            'Delete:BloqueHorario',
            // HorarioClinica (CRUD completo)
            'ViewAny:HorarioClinica',
            'View:HorarioClinica',
            'Create:HorarioClinica',
            'Update:HorarioClinica',
            'Delete:HorarioClinica',
            // Usuarios (CRUD sin eliminar)
            'ViewAny:User',
            'View:User',
            'Create:User',
            'Update:User',
            // ContactMessages (CRUD completo)
            'ViewAny:ContactMessage',
            'View:ContactMessage',
            'Create:ContactMessage',
            'Update:ContactMessage',
            'Delete:ContactMessage',
            // Solo lectura
            'ViewAny:Habitacion',
            'View:Habitacion',
            'ViewAny:Profesional',
            'View:Profesional',
            'ViewAny:Tratamiento',
            'View:Tratamiento',
            // Página y Widgets
            'View:MiPerfil',
            'View:ProximasCitasWidget',
            'View:TratamientoStatsWidget',
            'View:CancelacionInfoWidget',
        ],
        'publico' => [],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('╔════════════════════════════════════════════════════════════════╗');
        $this->info('║  Asignación de Permisos a Roles - FisioClinic                ║');
        $this->info('╚════════════════════════════════════════════════════════════════╝');
        $this->newLine();

        // Verificar roles y permisos
        $this->info('[1/5] Verificando roles y permisos...');

        $rolesCount = DB::table('roles')->count();
        $permissionsCount = DB::table('permissions')->count();

        if ($rolesCount < 5) {
            $this->error("✗ Error: Se esperaban 5 roles, pero solo se encontraron {$rolesCount}");
            $this->warn('Ejecuta primero: php artisan migrate:fresh --seed');
            return 1;
        }

        if ($permissionsCount < 100) {
            $this->error("✗ Error: Se esperaban al menos 100 permisos, pero solo se encontraron {$permissionsCount}");
            $this->warn('Ejecuta primero: php artisan shield:generate --all');
            return 1;
        }

        $this->line("  <fg=green>✓</> Roles encontrados: {$rolesCount}");
        $this->line("  <fg=green>✓</> Permisos encontrados: {$permissionsCount}");

        // Confirmar acción
        if (!$this->option('force')) {
            if (!$this->confirm('¿Deseas continuar con la asignación de permisos?', true)) {
                $this->warn('Operación cancelada por el usuario.');
                return 0;
            }
        }

        // Limpiar asignaciones previas (excepto super_admin)
        $this->newLine();
        $this->info('[2/5] Limpiando asignaciones previas (excepto super_admin)...');

        DB::table('role_has_permissions')
            ->whereIn('role_id', function ($query) {
                $query->select('id')
                    ->from('roles')
                    ->where('name', '!=', 'super_admin');
            })
            ->delete();

        $this->line('  <fg=green>✓</> Asignaciones anteriores eliminadas');

        // Asignar permisos
        $this->newLine();
        $this->info('[3/5] Asignando permisos a roles...');
        $this->newLine();

        foreach (self::ROLE_PERMISSIONS as $roleName => $permissions) {
            $count = count($permissions);
            $this->line("  <fg=cyan>→</> Asignando permisos a rol '{$roleName}' ({$count} permisos)");

            $role = DB::table('roles')->where('name', $roleName)->first();

            if (!$role) {
                $this->error("    ✗ Rol '{$roleName}' no encontrado");
                continue;
            }

            foreach ($permissions as $permissionName) {
                $permission = DB::table('permissions')->where('name', $permissionName)->first();

                if (!$permission) {
                    $this->warn("    ! Permiso '{$permissionName}' no encontrado");
                    continue;
                }

                DB::table('role_has_permissions')->insertOrIgnore([
                    'permission_id' => $permission->id,
                    'role_id' => $role->id,
                ]);
            }

            $this->line("    <fg=green>✓</> {$roleName}: {$count} permisos asignados");
        }

        // Super admin
        $superAdminPermisos = DB::table('role_has_permissions')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->where('roles.name', 'super_admin')
            ->count();

        $this->newLine();
        $this->line("  <fg=cyan>→</> Rol 'super_admin' mantiene todos los permisos");
        $this->line("    <fg=green>✓</> Super Admin: {$superAdminPermisos} permisos (sin cambios)");

        // Verificación
        $this->newLine();
        $this->info('[4/5] Verificando permisos asignados...');
        $this->newLine();

        $verification = DB::table('roles')
            ->leftJoin('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->select('roles.name', DB::raw('COUNT(role_has_permissions.permission_id) as permisos'))
            ->groupBy('roles.id', 'roles.name')
            ->orderBy('roles.name')
            ->get();

        $expectedCounts = [
            'cliente' => 10,
            'profesional' => 15,
            'publico' => 0,
            'recepcionista' => 34,
            'super_admin' => $superAdminPermisos,
        ];

        $errors = 0;
        $this->line('Verificación de Permisos:');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        foreach ($verification as $row) {
            $expected = $expectedCounts[$row->name] ?? '?';
            $actual = $row->permisos;

            if ($row->name === 'super_admin' || $actual == $expected) {
                $this->line("  <fg=green>✓</> {$row->name}: {$actual} permisos (esperado: {$expected})");
            } else {
                $this->line("  <fg=red>✗</> {$row->name}: {$actual} permisos (esperado: {$expected})");
                $errors++;
            }
        }

        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        // Reporte final
        $this->newLine();
        $this->info('[5/5] Reporte Final');
        $this->newLine();

        $this->line('═══════════════════════════════════════════════════════════════');
        $this->line('               REPORTE DE ASIGNACIÓN DE PERMISOS               ');
        $this->line('═══════════════════════════════════════════════════════════════');
        $this->newLine();
        $this->line('Resumen por Rol:');

        foreach ($verification as $row) {
            $percentage = $permissionsCount > 0 ? round(($row->permisos / $permissionsCount) * 100, 1) : 0;
            $this->line("  • {$row->name}: {$row->permisos} permisos ({$percentage}% del total)");
        }

        $this->newLine();
        $this->line("Total de permisos en sistema: {$permissionsCount}");
        $this->line("Total de roles configurados: {$rolesCount}");
        $this->newLine();

        if ($errors === 0) {
            $this->line('<fg=green;options=bold>✓ ÉXITO:</> <fg=green>Todos los permisos se asignaron correctamente</>');
            $this->newLine();
            $this->line('<fg=cyan>Jerarquía de Permisos:</>');
            $this->line('  super_admin (todos) > recepcionista (34) > profesional (15) > cliente (10) > publico (0)');
            $this->newLine();
            $this->line('<fg=yellow>Nota:</> Los permisos destructivos (ForceDelete, Restore, etc.) son exclusivos del super_admin');
            $this->newLine();
            $this->line('═══════════════════════════════════════════════════════════════');

            // Limpiar caché de permisos
            $this->call('permission:cache-reset');

            return 0;
        } else {
            $this->line("<fg=red;options=bold>✗ ERROR:</> <fg=red>Se encontraron {$errors} errores en la asignación</>");
            $this->newLine();
            $this->line('<fg=yellow>Solución sugerida:</>');
            $this->line('  1. Verifica que se hayan ejecutado las migraciones correctamente');
            $this->line('  2. Ejecuta: php artisan shield:generate --all');
            $this->line('  3. Vuelve a ejecutar este comando');
            $this->newLine();
            $this->line('═══════════════════════════════════════════════════════════════');

            return 1;
        }
    }
}
