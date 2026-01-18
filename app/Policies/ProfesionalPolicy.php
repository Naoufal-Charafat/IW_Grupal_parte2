<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Profesional;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfesionalPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Profesional');
    }

    public function view(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('View:Profesional');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Profesional');
    }

    public function update(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('Update:Profesional');
    }

    public function delete(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('Delete:Profesional');
    }

    public function restore(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('Restore:Profesional');
    }

    public function forceDelete(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('ForceDelete:Profesional');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Profesional');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Profesional');
    }

    public function replicate(AuthUser $authUser, Profesional $profesional): bool
    {
        return $authUser->can('Replicate:Profesional');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Profesional');
    }

}