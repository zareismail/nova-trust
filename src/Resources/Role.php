<?php 
namespace NovaTrust\Resources;

use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID; 
use Laravel\Nova\Fields\Text;  
use Laravel\Nova\Fields\MorphToMany; 
use Laravel\Nova\Fields\BelongsToMany;  
use Laravel\Nova\Fields\Boolean; 
use Laravel\Nova\Fields\Select; 
use NovaTrust\Fields\TeamSelection; 
use NovaTrust\Team; 

class Role extends Resource
{ 

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'NovaTrust\Role'; 

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return array_merge([
            ID::make(__('ID'), 'id')->sortable(), 
            Text::make(__('Name'), 'name')
                ->rules('required', 'regex:/[a-zA-Z][a-zA-Z-0-9\.-]+/')
                ->creationRules('unique:roles,name')
                ->updateRules('unique:roles,name,{{resourceId}}'),
            Text::make(__('Display Name'), 'display_name'),
            Text::make(__('Description'), 'description'), 
            BelongsToMany::make('Permissions'),
        ], $this->usersRelation());
    } 

    public function usersRelation()
    {
        return collect(config('nova-trust.user_resources'))->map(function($resource, $user) {
            return MorphToMany::make($user, null, $resource)->fields(new TeamSelection);
        })->all();
    } 

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
