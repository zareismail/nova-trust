<?php
namespace NovaTrust\Resources;

use  App\Nova\Resource as NovaResource;  
use Illuminate\Support\Str;

abstract class Resource extends NovaResource
{    
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Nova Trust'; 

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'display_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'display_name'
    ]; 

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group()
    {
        return __(static::$group);
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __(self::pluralLabel());
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __(Str::singular(self::pluralLabel()));
    }

    /**
     * Get the displayable plural label of the resource.
     *
     * @return string
     */
    public static function pluralLabel()
    {
        return Str::plural(Str::title(Str::snake(class_basename(get_called_class()), ' ')));
    }
}
