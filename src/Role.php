<?php

namespace NovaTrust;

use Illuminate\Database\Eloquent\Model; 
use Laratrust\Models\LaratrustRole;
use NovaTrust\Concerns\HasMutations;


class Role extends LaratrustRole
{
    use HasMutations;   

    /**
     * Many-to-Many relations with the permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
    	return parent::permissions()->using('NovaTrust\Pivot');
    }
}
