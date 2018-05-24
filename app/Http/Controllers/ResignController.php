<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingResignRequest;
use Illuminate\Support\Facades\DB;
use Mail;

class ResignController extends Controller
{
    public function resignForm(){

        return view('user.resign.resign-form');
    }


    public function submitResignForm(Request $request){

        $this->validate($request,[

            'to_email' => 'required',
            'submitted_date' => 'required',
            'employee_official_id' => 'required',
            'resigning_date' => 'required',
            'reason' => 'required'
        ]);
         $pendingRequestCount = DB::table('pending_resign_requests')->where('employee_official_id',$request->employee_official_id)->count();

         if ($pendingRequestCount == 0 ){

             $pendingResignRequest = new PendingResignRequest();

             $pendingResignRequest->employee_official_id = $request->employee_official_id;
             $pendingResignRequest->to_email = $request->to_email;
             $pendingResignRequest->submitted_date = $request->submitted_date;
             $pendingResignRequest->resigning_date = $request->resigning_date;
             $pendingResignRequest->reason = $request->reason;

             $pendingResignRequest->save();

             $data = $pendingResignRequest->toArray();

             Mail::send('user.resign.send-email', $data, function ($message) use ($data) {
                 $message->to($data['to_email']);
                 $message->subject('Cofirmation of employee resign application');
             });

             return redirect('/user/resign-form')->with('message','Application submitted successfully');
         } else {

             return redirect('/user/resign-form')->with('message','You have already one pending request.After confirm that you can apply a new request');
         }

    }

}
