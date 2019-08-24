<?php 
namespace NovaTrust\Resources;

use Laravel\Nova\Http\Requests\NovaRequest; 
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID; 
use Laravel\Nova\Fields\Text; 
use Laravel\Nova\Fields\Textarea; 
use Laravel\Nova\Fields\MorphToMany; 

class Team extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'NovaTrust\Team'; 

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(), 
            Text::make(__('Name'), 'name')
                ->rules('required', 'regex:/[a-zA-Z][a-zA-Z-0-9\.-]+/')
                ->creationRules('unique:teams,name')
                ->updateRules('unique:teams,name,{{resourceId}}'),
            Text::make(__('Display Name'), 'display_name'),
            Textarea::make(__('Description'), 'description'),
        ];
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
