<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HorarioClinica;
use Illuminate\Auth\Access\HandlesAuthorization;

class HorarioClinicaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HorarioClinica');
    }

    public function view(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('View:HorarioClinica');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HorarioClinica');
    }

    public function update(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('Update:HorarioClinica');
    }

    public function delete(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('Delete:HorarioClinica');
    }

    public function restore(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('Restore:HorarioClinica');
    }

    public function forceDelete(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('ForceDelete:HorarioClinica');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HorarioClinica');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HorarioClinica');
    }

    public function replicate(AuthUser $authUser, HorarioClinica $horarioClinica): bool
    {
        return $authUser->can('Replicate:HorarioClinica');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HorarioClinica');
    }

}