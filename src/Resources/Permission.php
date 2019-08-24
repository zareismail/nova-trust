<?php 
namespace NovaTrust\Resources;
 
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID; 
use Laravel\Nova\Fields\Text; 
use Laravel\Nova\Fields\Textarea; 
use Laravel\Nova\Fields\MorphToMany; 
use Laravel\Nova\TrashedStatus;
use NovaTrust\Fields\TeamSelection;
use NovaTrust\Helpers\PermissionContainer;

class Permission extends Resource
{  
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'NovaTrust\Permission'; 

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @param  array  $filters
     * @param  array  $orderings
     * @param  string  $withTrashed
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function buildIndexQuery(NovaRequest $request, $query, $search = null,
                                      array $filters = [], array $orderings = [],
                                      $withTrashed = TrashedStatus::DEFAULT)
    {
        PermissionContainer::sync();

        return static::applyOrderings(static::applyFilters(
            $request, static::initializeQuery($request, $query, $search, $withTrashed), $filters
        ), $orderings)->tap(function ($query) use ($request) {
            static::indexQuery($request, $query->with(static::$with));
        });
    }

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
            Text::make(__('Name'), 'name')->onlyOnIndex(),
            Text::make(__('Display Name'), 'display_name')->onlyOnIndex(),
            Text::make(__('Description'), 'description'),
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
