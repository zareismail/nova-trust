<?php

namespace NovaTrust;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaTrust extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    { 
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {  
        return view('nova-trust::navigation', [
            'resources' => [
                Resources\Role::class,
                Resources\Team::class,
                Resources\Permission::class,
            ]
        ]);
    }
}
