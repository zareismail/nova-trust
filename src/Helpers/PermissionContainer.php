<?php

namespace NovaTrust\Helpers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod; 
use NovaTrust\Permission;
 
 
class PermissionContainer
{ 
	/**
	 * Sycn available permission by stored permission in database.
	 * 
	 * @return void
	 */
	static public function sync()
	{
		$stored = Permission::get(); 
		$abilities = self::availableAbilities(); 

		$insertion = $abilities->reject(function($permission) use ($stored) {
			return $stored->firstWhere('name', $permission['name']);
		});
		$rejection = $stored->reject(function($permission) use ($abilities) {
			return $abilities->firstWhere('name', $permission->name);
		});

		Permission::insert($insertion->values()->all()); 
		Permission::whereIn('id', $rejection->pluck('id')->all())->delete();
	} 

	/**
	 * Preapare available abilities for storage.
	 * 
	 * @return \Illuminate\Support\Collection
	 */
	static public function availableAbilities()
	{  
		return collect(self::definedAbilities())->values()->merge(self::reservedAbilities());
	} 

	/**
	 * Fetch all definded abilities in the gate and policies.
	 * 
	 * @return \Illuminate\Support\Collection
	 */
	static public function definedAbilities()
	{
		return collect(Gate::abilities())->keys()->map(function($ability) {
			return self::preparingForStorage($ability);
		})->merge(self::policiesAbilities());
	}

	/**
	 * Fetch all public methods that definde on the registered policies.
	 * 
	 * @return \Illuminate\Support\Collection
	 */
	static public function policiesAbilities()
	{
		return collect(Gate::policies())->flatMap(function($policy, $resource) { 
            $resource = Str::lower(class_basename($resource)); 
            $methods = self::fetchPublicMethods($policy);

            return collect($methods)->map(function($ability) use ($resource) {
                return self::preparingForStorage("{$resource}.{$ability}");
            });
        });
	}

	/**
	 * Make array of reserved abilities
	 * 
	 * @return array
	 */
	static public function reservedAbilities()
	{  
		return collect(ReservedAbilities::all())->map(function($ability) {
			return self::preparingForStorage($ability);
		});
	} 

	/**
	 * Make array for fill model data
	 *  
	 * @param  string $ability 
	 * @return array          
	 */
	static public function preparingForStorage(string $ability)
	{
		return [
			'name'         => $ability,
			'display_name' => $display = self::displayName($ability),
			'description'  => $display,
		];
	}

	/**
	 * List all avaialbe public methods of an object.
	 * 
	 * @param  string $class 
	 * @return array        
	 */
	static public function fetchPublicMethods($class)
	{
        $reflection = new ReflectionClass($class); 

        return collect($reflection->getMethods(ReflectionMethod::IS_PUBLIC))->map->name->all();
	}

	/**
	 * Make displayable name for ability.
	 * 
	 * @param  string $ability 
	 * @return string          
	 */
	static public function displayName(string $ability)
	{
		$ability = str_replace('-', ' ', $ability);

		$name = collect(explode('.', $ability))->reverse()->filter()->implode(' ');

		return Str::title(Str::snake($name, ' '));
	}
}