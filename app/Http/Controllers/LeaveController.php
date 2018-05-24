<?php

namespace App\Http\Controllers;

use App\LeaveEmployee;
use App\PendingLeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use DateTime;

class LeaveController extends Controller
{
    public function leaveForm(){
        return view('user.leave.leave-form');
    }

    public function submitLeaveForm(Request $request){

        $this->validate($request,[

            'to_email' => 'required',
            'submitted_date' => 'required',
            'employee_official_id' => 'required',
            'leave_starting_date' => 'required',
            'leave_ending_date' => 'required',
            'reason' => 'required'
        ]);

       $pendingRequestCount = DB::table('pending_leave_requests')->where('employee_official_id',$request->employee_official_id)->count();

       if ($pendingRequestCount == 0) {

           $end=  $request->leave_starting_date;
           $start=  $request->leave_ending_date;
           $endDate = new DateTime($end);
           $startDate = new DateTime($start);
           $interval = $endDate->diff($startDate);
           $interval = $interval->format('%a');
           $intervals = $interval+1;


           $pendingLeaveRequest = new PendingLeaveRequest();

           $pendingLeaveRequest->employee_official_id = $request->employee_official_id;
           $pendingLeaveRequest->to_email = $request->to_email;
           $pendingLeaveRequest->submitted_date = $request->submitted_date;
           $pendingLeaveRequest->leave_starting_date = $request->leave_starting_date;
           $pendingLeaveRequest->leave_ending_date = $request->leave_ending_date;
           $pendingLeaveRequest->intervals = $intervals;
           $pendingLeaveRequest->reason = $request->reason;

           $pendingLeaveRequest->save();

           $data = $pendingLeaveRequest->toArray();

           Mail::send('user.leave.send-email', $data, function ($message) use ($data) {
               $message->to($data['to_email']);
               $message->subject('Cofirmation of employee leave application');
           });

           return redirect('/user/leave-form')->with('message','Application submitted successfully');
       } else {

           return redirect('/user/leave-form')->with('message','You have already one pending request.After confirm that you can apply a new request of leave of absence');
       }

    }
}
