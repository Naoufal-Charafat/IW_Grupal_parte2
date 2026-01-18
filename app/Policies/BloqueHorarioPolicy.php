<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BloqueHorario;
use Illuminate\Auth\Access\HandlesAuthorization;

class BloqueHorarioPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BloqueHorario');
    }

    public function view(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('View:BloqueHorario');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BloqueHorario');
    }

    public function update(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('Update:BloqueHorario');
    }

    public function delete(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('Delete:BloqueHorario');
    }

    public function restore(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('Restore:BloqueHorario');
    }

    public function forceDelete(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('ForceDelete:BloqueHorario');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BloqueHorario');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BloqueHorario');
    }

    public function replicate(AuthUser $authUser, BloqueHorario $bloqueHorario): bool
    {
        return $authUser->can('Replicate:BloqueHorario');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BloqueHorario');
    }

}