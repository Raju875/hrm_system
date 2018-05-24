<?php

namespace App\Http\Controllers;

use App\ExEmployee;
use Illuminate\Http\Request;
use DB;
use Session;

class ResignApprovalController extends Controller
{
    public function resignApprovalTable(){

        $pendingResignEmployees = DB::table('pending_resign_requests')->orderBy('id','desc')->get();

        return view('admin.resign.resign-approval-table',[
            'pendingResignEmployees' => $pendingResignEmployees
        ]);
    }


    public function pendingEmployeeResignInfoDetails($pendingEmployee){

        $pendingResignEmployee = DB::table('pending_resign_requests')->where('employee_official_id',$pendingEmployee)->first();

        $jobEmployee = DB::table('employee_job_infos')->where('employee_official_id',$pendingEmployee)->first();

        return view('admin.resign.pending-employee-resign-info-details',[
            'pendingResignEmployee' => $pendingResignEmployee,
            'jobEmployee' => $jobEmployee
        ]);
    }


    public function approveResignApplication($pendingEmployee){

      $employee = DB::table('employee_job_infos')
            ->join('employee_personal_infos', 'employee_personal_infos.id', '=', 'employee_job_infos.employee_id')
            ->where('employee_official_id',$pendingEmployee)
            ->select('employee_job_infos.*','employee_personal_infos.*')
            ->get();


      foreach ($employee as $employee){

          $exEmployee = new ExEmployee();

          $exEmployee->employee_official_id = $employee->employee_official_id;
          $exEmployee->employee_name = $employee->employee_name;
          $exEmployee->father_name = $employee->father_name;
          $exEmployee->mother_name = $employee->mother_name;
          $exEmployee->date_of_birth = $employee->date_of_birth;
          $exEmployee->phone_no = $employee->phone_no;
          $exEmployee->email = $employee->email;
          $exEmployee->national_id_no = $employee->national_id_no;
          $exEmployee->present_address = $employee->present_address;
          $exEmployee->official_email = $employee->official_email;
          $exEmployee->official_password = $employee->official_password;
          $exEmployee->official_phone_no = $employee->official_phone_no;
          $exEmployee->designation = $employee->designation;
          $exEmployee->salary = $employee->salary;
          $exEmployee->publication_status = $employee->publication_status;

          $exEmployee->save();

           DB::table('employee_job_infos')
               ->join('employee_personal_infos', 'employee_personal_infos.id', '=', 'employee_job_infos.employee_id')
               ->where('employee_official_id',$pendingEmployee)
               ->delete();

          DB::table('pending_resign_requests')->where('employee_official_id',$pendingEmployee)->delete();

      }

        return redirect('/employee/resign-approval-table')->with('message','Approve employee resign request successfully');
    }


    public function rejectResignApplication($pendingEmployee){

        DB::table('pending_resign_requests')->where('employee_official_id',$pendingEmployee)->delete();

        Session::put('rejectMessage','Sorry , Your leave application were rejected by Author');
        Session::put('rejectNotification','1');

        return redirect('/employee/resign-approval-table')->with('message','Reject resign application successfully');

    }
}
