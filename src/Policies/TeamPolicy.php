<?php

namespace NovaTrust\Policies;

use Illuminate\Contracts\Auth\Authenticatable as User;
use NovaTrust\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy 
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any teams.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the team.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function view(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine whether the user can create teams.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the team.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the team.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function delete(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the team.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function restore(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the team.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function forceDelete(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine if the user can add / associate models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function add(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine if the user can attach any models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function attachAny(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine if the user can attach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function attach(User $user, Team $team)
    {
        return true;
    }

    /**
     * Determine if the user can detach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Team $team
     * @return mixed
     */
    public function detach(User $user, Team $team)
    {
        return true;
    }  
}
