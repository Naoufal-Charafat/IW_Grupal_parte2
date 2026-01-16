<?php

namespace App\Policies;

use App\Models\Reserva;
use App\Models\User;

class ReservaPolicy
{
    /**
     * Determine if the user can view the reservation.
     */
    public function view(User $user, Reserva $reserva): bool
    {
        // User can view their own reservations
        return $user->id === $reserva->user_id;
    }

    /**
     * Determine if the user can update the reservation.
     */
    public function update(User $user, Reserva $reserva): bool
    {
        // User can update their own reservations if not yet completed
        return $user->id === $reserva->user_id 
            && $reserva->estado !== 'completado';
    }

    /**
     * Determine if the user can cancel the reservation.
     */
    public function cancel(User $user, Reserva $reserva): bool
    {
        // User can cancel their own reservations if confirmed or pending
        return $user->id === $reserva->user_id 
            && in_array($reserva->estado, ['confirmado', 'pendiente']);
    }
}
