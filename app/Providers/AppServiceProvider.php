<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Session;
use App\EmployeeJobInfo;
use Illuminate\Http\Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
//        if (Session::has('validUserEmail')){
//           $validUserEmail = Session::get('validUserEmail');
//           View::composer('user.*',function ($view){
//               $view->with('validUserEmail',EmployeeJobInfo::where('official_email','$validUserEmail')->first());
//           });
//        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
