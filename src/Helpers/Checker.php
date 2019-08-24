<?php 
namespace NovaTrust\Helpers;

use Illuminate\Contracts\Auth\Authenticatable as User;
use NovaTrust\Contracts\Ownable;

 
class Checker 
{ 
	/**
	 * Check user for an ability
	 * 
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user    
	 * @param  string $ability   
	 * @param  array  $arguments 
	 * @return [type]            
	 */
	static public function check(User $user, string $ability, array $arguments = [])
	{ 
        // Be Careful; developer user has access to everything
        // By default, we don't check permission if the user is the developer
        if(! static::isDeveloper($user)) { 
        	// First we attach other relevant abilities to current ability
        	$abilities = collect([
        		$ability, self::relevantFullAbility($ability)
        	])->filter()->all();

        	// First we check abilities without ownership
        	if(self::raw($user, $abilities, $arguments)) {  
        		return true;  
        	} 
 
        	// check for ownership access
        	return static::checkOwnershipAbility(
        		$user, self::ownershipAbility($ability), $arguments
        	);
        }

        return true;
	}

	/**
	 * Check multiple abilities
	 * 
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user    
	 * @param  array  $abilities 
	 * @param  array  $arguments 
	 * @return boolean 
	 */
	static public function raw(User $user, array $abilities, array $arguments = [])
	{ 
		// first we check teams ability and if passed; its has permission
    	if(self::checkTeamStrict() && self::checkWithTeams($user, $abilities)) {
    		return true;
    	}

    	return (boolean) $user->can($abilities, $arguments['team'] ?? null); 
	} 

	/**
	 * Check ability by user available teams.
	 * 
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user      
	 * @param  array  $abilities 
	 * @return boolean            
	 */
	static protected function checkWithTeams(User $user, array $abilities)
	{ 
		return $user->cachedTeams()->first(function($team) use ($user, $abilities) {
			return $user->can($abilities, $team->name);
		}) !== null; 
	}

	/**
	 * Check ablity for ownership
	 * 
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user     
	 * @param  string $ability  
	 * @param  array  $arguments
	 * @return boolean           
	 */
	static public function checkOwnershipAbility(User $user, string $ability, $arguments = [])
	{     
		if(isset($arguments[0])) { 
			$resource = is_object($arguments[0]) ? $arguments[0] : new $arguments[0]; 
 
			if($resource instanceof Ownable && $user->is($resource->owner)) {   
				return self::raw($user, (array) $ability, $arguments); 
			}
		}

		return false;
	}

	/**
	 * Check if user is developer.
	 * 
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user 
	 * @return boolean       
	 */
	static public function isDeveloper(User $user)
	{  
		return method_exists($user, 'isDeveloper') && $user->isDeveloper();
	}

	/**
	 * Find relevant full access ability
	 *  
	 * @param  string $ability 
	 * @return string          
	 */
	static public function relevantFullAbility(string $ability)
	{
		$abilities = PermissionContainer::basicAbilities()->pluck('name')->values();

		return collect($abilities)->first(function($name)  use ($ability) { 
			return ends_with($ability, ".{$name}");
		});
	}

	/**
	 * Make aownership ability name.
	 * Its posible to make ownership ability by append `Own` at the end of any ability string
	 * @param  string $ability 
	 * @return string          
	 */
	static public function ownershipAbility(string $ability)
	{ 
		return "{$ability}Own";
	}

	/**
	 * Detect team strcit check.
	 * 
	 * @param  void
	 * @return boolean
	 */
	static public function checkTeamStrict()
	{
		return (boolean) config('nova-trust.teams_strict_check');
	}
}