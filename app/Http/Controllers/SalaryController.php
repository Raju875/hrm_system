<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PendingAdvanceSalary;

class SalaryController extends Controller
{
    public function advanceSalaryForm(){

        $publishedEmployeeOfficialId = DB::table('employee_job_infos')->where('publication_status',1)->select('employee_official_id')->get();

        return view('user.salary.advance-salary-form',[

            'publishedEmployeeOfficialId' => $publishedEmployeeOfficialId
        ]);
    }


    public function submitAdvanceSalaryForm(Request $request){

        $this->validate($request,[

            'employee_official_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'amount' => 'required',
            'reason' => 'required'
        ]);

       $pendingRequestCount = DB::table('pending_advance_salaries')->where('employee_official_id',$request->employee_official_id)->count();

       if ($pendingRequestCount == 0) {

           $advanceSalary = new PendingAdvanceSalary();

           $advanceSalary->employee_official_id = $request->employee_official_id;
           $advanceSalary->date = $request->date;
           $advanceSalary->time = $request->time;
           $advanceSalary->amount = $request->amount;
           $advanceSalary->reason = $request->reason;

           $advanceSalary->save();

           return redirect('/user/advance-salary-form')->with('message','Advance salary form submitted successfully');
       } else {

           return redirect('/user/advance-salary-form')->with('message1','You have only one pending request !!! After confirm that you can apply for a new request');

       }

    }
}
