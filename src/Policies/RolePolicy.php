<?php

namespace NovaTrust\Policies;

use Illuminate\Contracts\Auth\Authenticatable as User;
use NovaTrust\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy 
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine if the user can add / associate models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function add(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine if the user can attach any models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function attachAny(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine if the user can attach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function attach(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine if the user can detach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Role $role
     * @return mixed
     */
    public function detach(User $user, Role $role)
    {
        return true;
    }  
}
