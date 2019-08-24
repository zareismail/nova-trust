<?php

/**
 * This file is part of NovaTrust,
 * a role & permission management solution for Laravel Nova Based On Larartrust.
 *
 * @license MIT
 * @package NovaTrust
 */ 
return [   
    /*
    |--------------------------------------------------------------------------
    | Strict check for roles/permissions inside teams
    |--------------------------------------------------------------------------
    |
    | Determines if a strict check should be done when checking if a role or permission
    | is attached inside a team.
    | If it's false, when checking a role/permission without specifying the team,
    | it will check only if the user has attached that role/permission ignoring the team.
    |
    */
    'teams_strict_check' => true,

    /*
    |--------------------------------------------------------------------------
    | NovaTrust User Resources
    |--------------------------------------------------------------------------
    |
    | This is the array that contains the information of the user resources.
    | This information is used in  the roles and permissions relationships 
    | with the possible user models.
    |
    | The key in the array is the name of the relationship inside the roles and permissions.
    |
    */
    'user_resources' => [
        'users' => 'App\Nova\User' 
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Manage Laratrust's cache configurations. It uses the driver defined in the
    | config/cache.php file.
    |
    */
    'cache' => [
        /*
        |--------------------------------------------------------------------------
        | Use cache in the package
        |--------------------------------------------------------------------------
        |
        | Defines if Laratrust will use Laravel's Cache to cache the roles and permissions.
        | NOTE: Currently the database check does not use cache.
        |
        */
        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Time to store in cache Laratrust's roles and permissions.
        |--------------------------------------------------------------------------
        |
        | Determines the time in SECONDS to store Laratrust's roles and permissions in the cache.
        |
        */
        'expiration_time' => 3600,
    ], 
];
