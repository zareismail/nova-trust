<?php
namespace NovaTrust;

use Illuminate\Database\Eloquent\Relations\Pivot as Model; 

class Pivot extends Model
{ 

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function($pivot) {
            $pivot->pivotParent->flushCache(); 
        });
        static::deleted(function ($pivot) { 
            $pivot->pivotParent->flushCache();
        });
    }
}
