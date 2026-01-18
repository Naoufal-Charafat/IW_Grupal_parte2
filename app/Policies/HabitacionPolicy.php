<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Habitacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class HabitacionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Habitacion');
    }

    public function view(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('View:Habitacion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Habitacion');
    }

    public function update(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('Update:Habitacion');
    }

    public function delete(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('Delete:Habitacion');
    }

    public function restore(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('Restore:Habitacion');
    }

    public function forceDelete(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('ForceDelete:Habitacion');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Habitacion');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Habitacion');
    }

    public function replicate(AuthUser $authUser, Habitacion $habitacion): bool
    {
        return $authUser->can('Replicate:Habitacion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Habitacion');
    }

}