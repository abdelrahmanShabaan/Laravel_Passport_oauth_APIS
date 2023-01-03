<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Laravel\Passport\Passport;



class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [

        // open this command line
        //add too in th up of this page that's passport use
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        // use passport routes
        Passport::routes();
    }
}
