<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;

class WelcomeController extends Controller
{
    public function index(){
        return view('admin.login.login');
    }

    public function dashboard(){
        return view('admin.home.home');
    }

    public function file(Request $request){

        //return $request->all();

     // $file =  $request->file('file');
        Input::file('file')->move('files/');
        return 'done';

      $fileName = $file->getClientOriginalName();
      $directory = 'files/';
      $url = $directory.$fileName;
      Image::make($file)->save($url);
      return 'done';
    }
}
