<?php
namespace NovaTrust\Fields;

use Laravel\Nova\Fields\MorphToMany;  
use NovaTrust\Resources\Team;

/**
 * 
 */
class MorphToManyTeams
{  
    static public function make()
    {  
		return MorphToMany::make('Teams', null, Team::class);
	}
}