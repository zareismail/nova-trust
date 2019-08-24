<?php

namespace NovaTrust;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustPermission;
use NovaTrust\Concerns\HasMutations;

class Permission extends LaratrustPermission
{
    use HasMutations; 
}
