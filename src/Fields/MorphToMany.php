<?php
namespace NovaTrust\Fields;   

/**
 * 
 */
class MorphToMany 
{  
    static public function fields()
    { 
		return [
			MorphToManyRoles::make(), 
			MorphToManyTeams::make(), 
			MorphToManyPermissions::make()
		];
	}
}