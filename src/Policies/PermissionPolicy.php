<?php

namespace NovaTrust\Policies;

use Illuminate\Contracts\Auth\Authenticatable as User;
use NovaTrust\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy 
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any permissions.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function restore(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function forceDelete(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the user can add / associate models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function add(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the user can attach any models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function attachAny(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the user can attach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function attach(User $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the user can detach models of the given type to the resource.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \NovaTrust\Permission $permission
     * @return mixed
     */
    public function detach(User $user, Permission $permission)
    {
        return true;
    }  
}
