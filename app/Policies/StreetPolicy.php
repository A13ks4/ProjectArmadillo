<?php

namespace App\Policies;

use App\User;
use App\Street;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the street.
     *
     * @param  \App\User  $user
     * @param  \App\Street  $street
     * @return mixed
     */
    public function view(User $user, Street $street)
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can create streets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can update the street.
     *
     * @param  \App\User  $user
     * @param  \App\Street  $street
     * @return mixed
     */
    public function update(User $user, Street $street)
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can delete the street.
     *
     * @param  \App\User  $user
     * @param  \App\Street  $street
     * @return mixed
     */
    public function delete(User $user, Street $street)
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can restore the street.
     *
     * @param  \App\User  $user
     * @param  \App\Street  $street
     * @return mixed
     */
    public function restore(User $user, Street $street)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the street.
     *
     * @param  \App\User  $user
     * @param  \App\Street  $street
     * @return mixed
     */
    public function forceDelete(User $user, Street $street)
    {
        //
    }
}
