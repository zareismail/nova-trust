<?php
namespace NovaTrust\Fields;

use Laravel\Nova\Fields\MorphToMany; 
use Laravel\Nova\Fields\Select; 
use NovaTrust\Team; 

/**
 * 
 */
class TeamSelection
{ 
 
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    { 
		return [
			Select::make('Team', 'team_id')->options(function() {
                return Team::get()->mapWithKeys(function($team) {
                    return [
                        $team->id => $team->display_name ?: $team->name,
                    ];
                })->toArray();
            })->nullable()->displayUsingLabels(),
		];
	}
}