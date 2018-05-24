<?php

namespace App\Http\Controllers;

use App\LeaveEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use DateTime;

class LeaveApprovalController extends Controller
{
    public function leaveApprovalTable(){

       $pendingLeaveEmployees = DB::table('pending_leave_requests')->orderBy('id','desc')->get();

        return view('admin.leave.leave-approval-table',[
            'pendingLeaveEmployees' => $pendingLeaveEmployees
        ]);
    }


    public function pendingEmployeeLeaveInfoDetails($pendingEmployee){

        $pendingLeaveEmployee = DB::table('pending_leave_requests')->where('employee_official_id',$pendingEmployee)->first();

        $jobEmployee = DB::table('employee_job_infos')->where('employee_official_id',$pendingEmployee)->first();

        return view('admin.leave.pending-employee-leave-info-details',[

            'pendingLeaveEmployee' => $pendingLeaveEmployee,
            'jobEmployee' => $jobEmployee

            ]);
    }

    public function approveLeaveApplication($pendingEmployee){


        $pendingLeaveEmployee = DB::table('pending_leave_requests')->where('employee_official_id',$pendingEmployee)->first();

         $leaveEmployee = new LeaveEmployee();

         $leaveEmployee->employee_official_id = $pendingLeaveEmployee->employee_official_id;
         $leaveEmployee->to_email = $pendingLeaveEmployee->to_email;
         $leaveEmployee->submitted_date = $pendingLeaveEmployee->submitted_date;
         $leaveEmployee->leave_starting_date = $pendingLeaveEmployee->leave_starting_date;
         $leaveEmployee->leave_ending_date = $pendingLeaveEmployee->leave_ending_date;
         $leaveEmployee->intervals = $pendingLeaveEmployee->intervals;
         $leaveEmployee->reason = $pendingLeaveEmployee->reason;

         $leaveEmployee->save();

         DB::table('pending_leave_requests')->where('employee_official_id',$pendingEmployee)->delete();

         return redirect('/employee/leave-approval-table')->with('message','Approve employee leave request');
    }


    public function rejectLeaveApplication($pendingEmployee){

        DB::table('pending_leave_requests')->where('employee_official_id',$pendingEmployee)->delete();

        Session::put('rejectMessage','Sorry , Your leave application were rejected by Author');
        Session::put('rejectNotification','1');

        return redirect('/employee/leave-approval-table')->with('message','Reject leave application successfully');
    }


    public function currentMonthLeaveEmployees(){

        date_default_timezone_set('Asia/Dhaka');

        $currentMonth = date('m');

        $leaveEmployees = DB::table('leave_employees')->whereMonth('leave_starting_date',$currentMonth)->orderBy('id','desc')->get();


        return view('admin.leave.current-month-leave-employees',[
            'leaveEmployees' => $leaveEmployees
        ]);
    }


    public function selectMonthLeaveEmployees(){

        return view('admin.leave.select-month-leave-employees');
    }


    public function selectMonthForLeaveReport(Request $request){

        $this->validate($request, [
            'month' => 'required'
        ]);

        $month = date('m',strtotime( $request->month));
        $year = date('Y', strtotime($request->month));

        $countMonth = DB::table('leave_employees')->whereMonth('leave_starting_date',$month)->count();
        $countYear = DB::table('leave_employees')->whereYear('leave_starting_date',$year)->count();

        if ( $countYear != 0 ){

            if ( $countMonth != 0){

                $querryByMonth = DB::table('leave_employees')->whereMonth('leave_starting_date',$month)->get();

                return view('admin.leave.select-month-for-leave-report',[

                    'querryByMonth' => $querryByMonth

                ]);
            }else{

                return redirect('/employee/select-month-leave-employees')->with('message','Selected wrong month');
                //select wrong month
            }


        }else{

            return redirect('/employee/select-month-leave-employees')->with('message','Selected wrong year');
            //select wrong year
        }

    }

}
