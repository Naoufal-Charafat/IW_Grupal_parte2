<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Tratamiento;
use Illuminate\Auth\Access\HandlesAuthorization;

class TratamientoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Tratamiento');
    }

    public function view(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('View:Tratamiento');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Tratamiento');
    }

    public function update(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('Update:Tratamiento');
    }

    public function delete(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('Delete:Tratamiento');
    }

    public function restore(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('Restore:Tratamiento');
    }

    public function forceDelete(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('ForceDelete:Tratamiento');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Tratamiento');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Tratamiento');
    }

    public function replicate(AuthUser $authUser, Tratamiento $tratamiento): bool
    {
        return $authUser->can('Replicate:Tratamiento');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Tratamiento');
    }

}