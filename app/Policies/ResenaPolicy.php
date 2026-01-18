<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Resena;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResenaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Resena');
    }

    public function view(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('View:Resena');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Resena');
    }

    public function update(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('Update:Resena');
    }

    public function delete(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('Delete:Resena');
    }

    public function restore(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('Restore:Resena');
    }

    public function forceDelete(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('ForceDelete:Resena');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Resena');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Resena');
    }

    public function replicate(AuthUser $authUser, Resena $resena): bool
    {
        return $authUser->can('Replicate:Resena');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Resena');
    }

}