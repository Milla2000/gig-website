<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    //remove guard and allow form to post data to database without fillable
        //if you use this function be aware of what is going into the database
        //Model::unguard();
        //Paginator::useBootstrapFive();//use documentation  to go further
    }
}
