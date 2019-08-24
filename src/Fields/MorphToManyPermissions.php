<?php
namespace NovaTrust\Fields;

use Laravel\Nova\Fields\MorphToMany;  
use NovaTrust\Resources\Permission;

/**
 * 
 */
class MorphToManyPermissions
{  
    static public function make()
    { 
		return MorphToMany::make('Permissions', null, Permission::class)->fields(
			new TeamSelection
		);
	}
}