<?php

namespace App\Http\Controllers;

use App\AdvanceSalary;
use App\PendingAdvanceSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayrollController extends Controller
{

    public function advanceSalaryApproval(){

       $pendingAdvanceSalaries = DB::table('pending_advance_salaries')->get();

        return view('admin.payroll.advance-salary-approval',[

            'pendingAdvanceSalaries' => $pendingAdvanceSalaries
        ]);
    }


    public function approveAdvanceSalaryRequest($pendingEmployee){

        $pendingEmployee = PendingAdvanceSalary::where('employee_official_id',$pendingEmployee)->first();

           $advanceSalary = new AdvanceSalary();

           $advanceSalary->employee_official_id = $pendingEmployee->employee_official_id;
           $advanceSalary->application_date = $pendingEmployee->date;
           $advanceSalary->amount = $pendingEmployee->amount;
           $advanceSalary->reason = $pendingEmployee->reason;

           $advanceSalary->save();

        DB::table('pending_advance_salaries')->where('employee_official_id',$pendingEmployee)->delete();

        return redirect('/payroll/advance-salary-approval')->with('message','Pending advance salary request approve successfully');
    }


    public function rejectAdvanceSalaryRequest($pendingEmployee){

        DB::table('pending_advance_salaries')->where('employee_official_id',$pendingEmployee)->delete();

        return redirect('/payroll/advance-salary-approval')->with('message','Pending advance salary request reject successfully');

    }


    public function selectEmployee(){

        $currentMonth = date('m');

        $advamceSalaryCount = DB::table('advance_salaries')->whereMonth('application_date',$currentMonth)->count();

        if ($advamceSalaryCount != 0){

            $advanceEmployees = DB::table('advance_salaries')->select('employee_official_id')->distinct()->get();

            return view('admin.payroll.select-advance-employee',[

                'advanceEmployees' => $advanceEmployees
            ]);
        } else {

            return redirect('/payroll/empty-advance-salary')->with('message',date('F Y').' : no employee is here');
        }
    }


    public function emptyAdvanceSalary(){

        return view('admin.payroll.empty-advance-salary');
    }


    public function viewAdvanceEmployees(Request $request){

        $this->validate($request,[
            'employee_official_id' => 'required'
        ]);

        $employee = $request->employee_official_id ;

       $advanceEmplouees = DB::table('advance_salaries')->where('employee_official_id',$request->employee_official_id)->get();

       return view('admin.payroll.advance-salary-employee',[

           'advanceEmplouees' => $advanceEmplouees,
           'employee' => $employee
       ]);
    }


    public function employeeSalarySheet(){

        $employeeJobInfos = DB::table('employee_job_infos')->where('publication_status',1)->get();

        $currentMonth = date('m');

        $employeeAttendance = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->get();

       // $employeeAbsent = DB::table('absent_employees')->whereMonth('absent_date',$currentMonth)->get();

        $leaveEmployees = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->get();

        $damarages = DB::table('damarages')->where('date',$currentMonth)->get();

        $advanceSalaries = DB::table('advance_salaries')->where('application_date',$currentMonth)->get();

        return view('admin.payroll.salary-sheet',[

            'employeeJobInfos' => $employeeJobInfos,
            'currentMonth' => $currentMonth,
            'employeeAttendance' => $employeeAttendance,
          //  'employeeAbsent' => $employeeAbsent,
            'leaveEmployees' => $leaveEmployees,
            'damarages' => $damarages,
            'advanceSalaries' => $advanceSalaries
        ]);
    }


}
