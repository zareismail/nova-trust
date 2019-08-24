<?php

namespace NovaTrust;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustTeam;
use NovaTrust\Concerns\HasMutations;

class Team extends LaratrustTeam
{
    use HasMutations;
}
