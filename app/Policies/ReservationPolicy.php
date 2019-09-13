<?php

namespace App\Policies;

use App\User;
use App\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    

    /**
     * Determine whether the user can view the reservation.
     *
     * @param  \App\User  $user
     * @param  \App\Reservation  $reservation
     * @return mixed
     */
    public function view(User $user, Reservation $reservation)
    {
        if($reservation->schedule != null){
            return $user->id == $reservation->user_id || $user->id == $reservation->schedule->driver->id || $user->isAdmin();
        }else
            return $user->id == $reservation->user_id || $user->isAdmin(); // Prikazuje samo rezervacije od trenutno logovanog usera
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create reservations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function reserve(User $user)
    {
        return $user->isClient();
    }

    /**
     * Determine whether the user can update the reservation.
     *
     * @param  \App\User  $user
     * @param  \App\Reservation  $reservation
     * @return mixed
     */
    public function update(User $user, Reservation $reservation)
    {
        return $user->isAdmin() || $user->id == $reservation->user_id;
    }

    /**
     * Determine whether the user can delete the reservation.
     *
     * @param  \App\User  $user
     * @param  \App\Reservation  $reservation
     * @return mixed
     */
    public function delete(User $user, Reservation $reservation)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the reservation.
     *
     * @param  \App\User  $user
     * @param  \App\Reservation  $reservation
     * @return mixed
     */
    public function restore(User $user, Reservation $reservation)
    {
        
    }

    /**
     * Determine whether the user can permanently delete the reservation.
     *
     * @param  \App\User  $user
     * @param  \App\Reservation  $reservation
     * @return mixed
     */
    public function forceDelete(User $user, Reservation $reservation)
    {
        //
    }
}
