<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Reserva;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Reserva');
    }

    public function view(AuthUser $authUser, Reserva $reserva): bool
    {
        // Allow if user has permission or is the owner of the reservation
        return $authUser->can('View:Reserva') || $authUser->id === $reserva->user_id;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Reserva');
    }

    public function update(AuthUser $authUser, Reserva $reserva): bool
    {
        return $authUser->can('Update:Reserva');
    }

    public function delete(AuthUser $authUser, Reserva $reserva): bool
    {
        return $authUser->can('Delete:Reserva');
    }

    public function restore(AuthUser $authUser, Reserva $reserva): bool
    {
        return $authUser->can('Restore:Reserva');
    }

    public function forceDelete(AuthUser $authUser, Reserva $reserva): bool
    {
        return $authUser->can('ForceDelete:Reserva');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Reserva');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Reserva');
    }

    public function replicate(AuthUser $authUser, Reserva $reserva): bool
    {
        return $authUser->can('Replicate:Reserva');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Reserva');
    }

}