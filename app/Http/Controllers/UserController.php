<?php

namespace App\Http\Controllers;

use App\EmployeeAttendence;
use App\EmployeePersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{
    public function userLoginForm(){
        if (Session::has('validUserOfficialId')){
            return redirect('/user/home');
        }else{
            return view('user.login.loginForm');
        }

    }


  public function userLoginCheck(Request $request){
       // return $request->password;

      if( $validUser = DB::table('employee_job_infos')->where('official_email', $request->email)->first() ) {

          if(password_verify($request->password,$validUser->official_password)){
              $validUserOfficialEmail = $validUser->official_email;
              $validUserOfficialId = $validUser->employee_official_id;
              //return $validUserOfficialEmail;
              Session::put('validUserOfficialEmail',$validUserOfficialEmail);
              Session::put('validUserOfficialId',$validUserOfficialId);

              return redirect('/user/home');

          }else{
              return redirect('/user')->with('message','Wrong password!!!');
          }

      }else{
          return redirect('/user')->with('message','Invalid Email!!!');
      }

    }


    public function userLogout(){
        Session::forget('validUserOfficialEmail');
        Session::forget('validUserOfficialId');

        return redirect('/user')->with('message','You are successfully logged out');
    }


    public function userHome(){

        return view('user.home.home');
    }


    public function damageNotificationSession(){

        Session::forget('rejectMessage');
        Session::forget('rejectNotification');

        return view('user.home.home');
    }



}
