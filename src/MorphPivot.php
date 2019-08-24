<?php

namespace NovaTrust;

use  Illuminate\Database\Eloquent\Relations\MorphPivot as Pivot; 

class MorphPivot extends Pivot
{ 

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function($model) {
            $model->pivotParent->flushCache(); 
        });
        static::deleted(function ($pivot) { dd($pivot);
            $pivot->pivotParent->flushCache();
        });
    }

}
