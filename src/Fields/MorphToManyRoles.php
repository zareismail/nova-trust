<?php
namespace NovaTrust\Fields;

use Laravel\Nova\Fields\MorphToMany;  
use NovaTrust\Resources\Role;

/**
 * 
 */
class MorphToManyRoles
{  
    static public function make()
    { 
		return MorphToMany::make('Roles', null, Role::class)->fields(
			new TeamSelection
		);
	}
}