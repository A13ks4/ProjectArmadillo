<?php

namespace App\Policies;

use App\User;
use App\City;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function view(User $user, City $city)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create cities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function update(User $user, City $city)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function delete(User $user, City $city)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
