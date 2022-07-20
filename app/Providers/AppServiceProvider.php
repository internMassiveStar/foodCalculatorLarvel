<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
    {  
    //     if(Auth::check()){
    //     $companyId=Auth::user()->role;
    //     print_r($companyId);
    //     echo $companyId;

        
    //     config(['companyId' => $companyId]);
    // }
       
    }
}
