<?php
namespace NovaTrust\Concerns;

/**
 * This file is part of NovaTrsut,
 * a role & permission management solution for Laravel Nova.
 *
 * @license MIT
 * @package NovaTrust
 */

use Laratrust\Traits\LaratrustUserTrait;
use Laratrust\Helper;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Laratrust\Checkers\LaratrustCheckerManager;

trait InteractsWithNovaTrust
{
    use LaratrustUserTrait {
        roles as laratrustRoles;
        rolesTeams as laratrustRolesTeams;
        permissions as laratrustPermissions;
        flushCache as laratrustFlushCache;
    }
    
    /**
     * The class name of the custom pivot model to use for the relationship.
     *
     * @var string
     */
    protected $using = 'NovaTrust\MorphWith';

    /**
     * Boots the user model and attaches event listener to
     * remove the many-to-many records when trying to delete.
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function bootInteractsWithNovaTrust()
    {
        self::bootLaratrustUserTrait();  

        static::deleting(function ($user) {
            if (method_exists($user, 'bootSoftDeletes') && !$user->forceDeleting) {
                return;
            }

            $user->teams()->sync([]); 
        });
    }



    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function roles()
    {
        return $this->laratrustRoles()->using(\NovaTrust\MorphPivot::class);
    }

    /**
     * Many-to-Many relations with Team associated through the roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function rolesTeams()
    {
        return $this->laratrustRolesTeams()->using(\NovaTrust\MorphPivot::class);
    }


    /**
     * Many-to-Many relations with Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function permissions()
    {
        return $this->laratrustPermissions()->using(\NovaTrust\MorphPivot::class);
    }

    /**
     * Many-to-Many relations with Team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function teams()
    {
        return $this->morphToMany(
            Config::get('laratrust.models.team', 'NovaTrust\\Team'),
            'user',
            Config::get('laratrust.tables.team_user', 'team_user'),
            Config::get('laratrust.foreign_keys.team', 'team_id'),
            Config::get('laratrust.foreign_keys.user', 'user_id')
        )->using(\NovaTrust\MorphPivot::class);  
    } 


    /**
     * Flush the user's cache.
     *
     * @return void
     */
    public function flushCache()
    {
        $this->laratrustFlushCache();
        Cache::forget('laratrust_teams_for_user_' . $this->getKey());
    }

    public function cachedTeams()
    {
        $cacheKey = 'laratrust_teams_for_user_' . $this->getKey();
        
        if (! config('laratrust.cache.enabled')) {
            return $this->teams()->get();
        }

        return Cache::remember($cacheKey, config('laratrust.cache.expiration_time', 60), function () {
            return $this->teams()->get();
        });   
    }
}
