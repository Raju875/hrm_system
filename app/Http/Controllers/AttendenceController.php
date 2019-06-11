<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EmployeeAttendence;
use App\EmployeeJobInfo;
use App\AbsentEmployee;
use App\TemporaryAbsentEmployee;
use Illuminate\Support\Facades\Input;
use PDF;

class AttendenceController extends Controller
{

    public function currentDate(){

        date_default_timezone_set('Asia/Dhaka');

        $attendanceCount = DB::table('employee_attendences')->where('attendence_date',date("Y-m-d"))->count();
        $absenceCount    = DB::table('absent_employees')->where('absent_date',date("Y-m-d"))->count();
        $employeesCount  = DB::table('employee_job_infos')->count();

        if($attendanceCount == 0){

            $absentEmployees = DB::table('employee_job_infos')->get();

            return view('admin.attendence.current-date-attendance-table',[
                'employeesCount'  => $employeesCount,
                'attendanceCount' => $attendanceCount,
                'absenceCount'    => $absenceCount,
                'absentEmployees' => $absentEmployees

            ]);

        } else {

         $presentEmployees = DB::table('employee_attendences')->where('attendence_date',date("Y-m-d"))->get();
         $absentEmployees = DB::table('absent_employees')->where('absent_date',date("Y-m-d"))->get();

       return view('admin.attendence.current-date-attendance-table',[
            'presentEmployees' => $presentEmployees,
            'absentEmployees'  => $absentEmployees,
            'employeesCount'   => $employeesCount,
            'attendanceCount'  => $attendanceCount,
            'absenceCount'     => $absenceCount

       ]);
     }
    }


    public function selectAttendenceDate(){

        return view('admin.attendence.select-attendence-date');
    }


    public function dailyAttendenceReport(Request $request){

        $this->validate($request,[
            'attendence_date'=>'required'
        ]);

       $selectDate = $request->attendence_date;

       $querryDate = DB::table('employee_attendences')->distinct()->get(['attendence_date']);

       foreach ($querryDate as $querryDate) {

           if ( $selectDate == $querryDate->attendence_date) {

               $presentEmployeesByDate = DB::table('employee_attendences')->where('attendence_date', $request->attendence_date)->orderBy('id', 'desc')->get();
               $presentEmployeesCount  = DB::table('employee_attendences')->where('attendence_date', $request->attendence_date)->orderBy('id', 'desc')->get()->count();
               $allJobEmployees        = DB::table('employee_job_infos')->orderBy('id', 'desc')->get();
               $jobEmployeesCount      = DB::table('employee_job_infos')->orderBy('id', 'desc')->get()->count();
               $allPersonalEmployees   = DB::table('employee_personal_infos')->orderBy('id', 'desc')->get();
               $absentEmployees        = DB::table('absent_employees')->where('absent_date',$selectDate)->orderBy('id','desc')->get();
               $absentEmployeesCount   = DB::table('absent_employees')->where('absent_date',$selectDate)->count();

               return view('admin.attendence.employee-attendence-table', [
                   'presentEmployeesByDate' => $presentEmployeesByDate,
                   'allJobEmployees' => $allJobEmployees,
                   'allPersonalEmployees' => $allPersonalEmployees,
                   'presentEmployeesCount' => $presentEmployeesCount,
                   'jobEmployeesCount' => $jobEmployeesCount,
                   'absentEmployees' => $absentEmployees,
                   'absentEmployeesCount' => $absentEmployeesCount,
                   'selectDate' => $selectDate
               ]);
           }
       }
        return redirect('/employee/select-attendence-date')->with('message','Wrong date selected!!!');
    }


    public function selectEmployeeForCurrentMonthAttendanceReport(){

       $publishedEmployees = DB::table('employee_job_infos')->where('publication_status',1)->get();

        return view('admin.attendence.select-employee',[
            'publishedEmployees' => $publishedEmployees
        ]);
    }


    public function employeeSelectCurrentMonthAttendanceReport(Request $request){

      // return $request->employee_official_id;

        date_default_timezone_set('Asia/Dhaka');

        $this->validate($request,[
            'employee_official_id' => 'required'
        ]);

        $employeeOfficialId = $request->employee_official_id;
        $currentMonth       = date('m');
        $currentYear       = date('Y');

        $employeeAttendOffice       = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->whereYear('attendence_date',$currentYear)->where('employee_official_id',$employeeOfficialId)->count();
        $employeeAbsentOffice       = DB::table('absent_employees')->whereMonth('absent_date',$currentMonth)->whereYear('absent_date',$currentYear)->where('employee_official_id',$employeeOfficialId)->count();

        $leaveCount = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->whereYear('submitted_date',$currentYear)->where('employee_official_id',$request->employee_official_id)->select('intervals')->count();

        if( $leaveCount != 0 ) {
            $leaveEmployee = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->whereYear('submitted_date',$currentYear)->where('employee_official_id',$request->employee_official_id)->select('intervals')->get();
            $intervals     = 0;

            foreach ($leaveEmployee as $leaveEmployee){

                $count     = (int)$leaveEmployee->intervals;
                $intervals = $intervals + $count ;

            }

            return view('admin.attendence.employee-select-current-month-attendance-report',[
                'employeeAttendOffice' => $employeeAttendOffice,
                'employeeAbsentOffice' => $employeeAbsentOffice,
                'employeeOfficialId'   => $employeeOfficialId,
                'intervals'            => $intervals
            ]);

        } else {

            $intervals = 0;

            return view('admin.attendence.employee-select-current-month-attendance-report',[
                'employeeAttendOffice' => $employeeAttendOffice,
                'employeeAbsentOffice' => $employeeAbsentOffice,
                'employeeOfficialId'   => $employeeOfficialId,
                'intervals'            => $intervals

            ]);
        }
    }


    public function currentMonthAttendanceReportDownload($employeeOfficialId ){

        date_default_timezone_set('Asia/Dhaka' );

        $employeeOfficialId   = $employeeOfficialId;
        $currentMonth         = date('m');
        $currentYear          = date('Y');
        $employeeAttendOffice = DB::table('employee_attendences' )->whereMonth('attendence_date',$currentMonth )->whereYear('attendence_date',$currentYear )->where('employee_official_id',$employeeOfficialId)->count();
        $employeeAbsentOffice = DB::table('absent_employees')->whereMonth('absent_date',$currentMonth )->whereYear('absent_date',$currentYear )->where('employee_official_id',$employeeOfficialId )->count();

        $count                = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->whereYear('submitted_date',$currentYear)->where('employee_official_id',$employeeOfficialId)->select('intervals')->count();

        if ($employeeAttendOffice == 0 ) {
            if ($employeeAbsentOffice == 0 ) {
                if ($count == 0 ) {

                    return redirect('/employee/select-employee-for-current-month-attendance-report')->with('message','You select wrong employee!!!');

                }
            }
        }

       if ($count != 0 ) {
           $leaveEmployeeInfoByDate = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->whereYear('submitted_date',$currentYear)->where('employee_official_id',$employeeOfficialId)->select('intervals')->get();

           $intervals = 0;

           foreach ($leaveEmployeeInfoByDate as $leaveEmployeeInfoByDate){

                   $intervals = $intervals + (int)$leaveEmployeeInfoByDate->intervals ;
           }

           $pdf = PDF::loadView('admin.attendence.pdf-monthly-attendence-report',[
               'employeeAttendOffice' => $employeeAttendOffice,
               'employeeAbsentOffice' => $employeeAbsentOffice,
               'employeeOfficialId' => $employeeOfficialId,
               'intervals' => $intervals
           ]);

           return $pdf->stream('monthlty-attandance-report.pdf');

       } else {

           $intervals = 0;

           $pdf = PDF::loadView('admin.attendence.pdf-monthly-attendence-report',[
               'employeeAttendOffice' => $employeeAttendOffice,
               'employeeAbsentOffice' => $employeeAbsentOffice,
               'employeeOfficialId' => $employeeOfficialId,
               'intervals' => $intervals
           ]);
           return $pdf->stream('monthlty-attandance-report.pdf');
       }

    }


    public function allEmployeesCurrentMonthAttendanceReport(){

        date_default_timezone_set('Asia/Dhaka');

        $currentMonth = date('m');
        $currentYear  = date('Y');

        $count        = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->whereYear('attendence_date',$currentYear)->count();

       if ($count != 0 ){

           $allEmployees    = DB::table('employee_job_infos')->select('employee_official_id')->orderBy('id','asc')->get();
           $allEmployees    = DB::table('employee_job_infos')->select('employee_official_id')->orderBy('id','asc')->get();
           $attendances     = DB::table('employee_attendences')->groupBy('employee_official_id')->whereMonth('attendence_date',$currentMonth)->whereYear('attendence_date',$currentYear)->select('employee_official_id')->orderBy('id','asc')->get();
           $nullAttendances = DB::table('employee_job_infos')->leftJoin('employee_attendences','employee_job_infos.employee_official_id','=','employee_attendences.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('employee_attendences.employee_official_id')->get();
           $absents         = DB::table('absent_employees')->groupBy('employee_official_id')->whereMonth('absent_date',$currentMonth)->whereYear('absent_date',$currentYear)->select('employee_official_id',DB::raw('count(*) as totalAbsent'))->get();
           $nullAbsents     = DB::table('employee_job_infos')->leftJoin('absent_employees','employee_job_infos.employee_official_id','=','absent_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('absent_employees.employee_official_id')->get();
           $leaves          = DB::table('leave_employees')->groupBy('employee_official_id')->whereMonth('leave_starting_date',$currentMonth)->whereYear('leave_starting_date',$currentYear)->select('employee_official_id', DB::raw('SUM(intervals) as intervals'))->get();
           $nullLeaves      = DB::table('employee_job_infos')->leftJoin('leave_employees','employee_job_infos.employee_official_id','=','leave_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('leave_employees.employee_official_id')->get();

          return DB::table('employee_job_infos')
               ->leftJoin('employee_attendences','employee_job_infos.employee_official_id','=','employee_attendences.employee_official_id')
               ->select('employee_job_infos.*','employee_attendences.*')
              ->whereMonth('employee_attendences.attendence_date',$currentMonth)->whereYear('employee_attendences.attendence_date',$currentYear)
              // ->where('employee_job_infos.employee_official_id','!=','employee_attendences.employee_official_id')
               ->get();

           return view('admin.attendence.all-employees-current-month-attendance-report',[
               'allEmployees'    => $allEmployees,
               'attendances'     => $attendances,
               //'nullAttendances' => $nullAttendances,
               'absents'         => $absents,
               'nullAbsents'     => $nullAbsents,
               'leaves'          => $leaves,
               'nullLeaves'      => $nullLeaves,
               'currentMonth'    => $currentMonth
           ]);

       }else{

           return redirect('employee/all-employees-current-month-attendance-report')->with('message','Np Employees are here.Please first add any employee');
       }

    }


    public function allEmployeeCurrentMonthAttendanceReportDownload(){

        date_default_timezone_set('Asia/Dhaka');

        $currentMonth = date('m');
        $currentYear  = date('Y');

        $count        = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->whereYear('attendence_date',$currentYear)->count();

        if ($count != 0 ){

            $allEmployees    = DB::table('employee_job_infos')->select('employee_official_id')->orderBy('id','asc')->get();
            $attendances     = DB::table('employee_attendences')->groupBy('employee_official_id')->whereMonth('attendence_date',$currentMonth)->whereYear('attendence_date',$currentYear)->select('employee_official_id',DB::raw('count(*) as totalAttendance'))->orderBy('id','asc')->get();
            $nullAttendances = DB::table('employee_job_infos')->leftJoin('employee_attendences','employee_job_infos.employee_official_id','=','employee_attendences.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('employee_attendences.employee_official_id')->get();
            $absents         = DB::table('absent_employees')->groupBy('employee_official_id')->whereMonth('absent_date',$currentMonth)->whereYear('absent_date',$currentYear)->select('employee_official_id',DB::raw('count(*) as totalAbsent'))->get();
            $nullAbsents     = DB::table('employee_job_infos')->leftJoin('absent_employees','employee_job_infos.employee_official_id','=','absent_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('absent_employees.employee_official_id')->get();
            $leaves          = DB::table('leave_employees')->groupBy('employee_official_id')->whereMonth('leave_starting_date',$currentMonth)->whereYear('leave_starting_date',$currentYear)->select('employee_official_id', DB::raw('SUM(intervals) as intervals'))->get();
            $nullLeaves      = DB::table('employee_job_infos')->leftJoin('leave_employees','employee_job_infos.employee_official_id','=','leave_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('leave_employees.employee_official_id')->get();

            $pdf = PDF::loadView('admin.attendence.pdf-current-month-all-employees-monthly-attendance-report',[
                'allEmployees'    =>  $allEmployees,
                'attendances'     => $attendances,
                'nullAttendances' => $nullAttendances,
                'absents'         => $absents,
                'nullAbsents'     => $nullAbsents,
                'leaves'          => $leaves,
                'nullLeaves'      => $nullLeaves,
                'currentMonth'    => $currentMonth
            ]);

            return $pdf->stream('employees-monthlty-attandance-report.pdf');

        }
        else{

            return redirect('employee/all-employees-current-month-attendance-report')->with('message','No Employees are here.Please first add any employee');
        }
    }


    public function employeeMonthSelectForm(){

        $publishedEmployees = DB::table('employee_job_infos')->where('publication_status',1)->get();
        return view('admin.attendence.employee-month-select-form',[
            'publishedEmployees' => $publishedEmployees
        ]);
    }


    public function selectEmployeeMonthAttendanceReport(Request $request){

        //return $request->all();
        $month              = $request->month;
        $selectEmployee     = $request->publishedEmployee;
        $selectMonth        = date("m", strtotime($request->month));
        $selectYear         = date("Y", strtotime($request->month));

        $attendanceCount    = DB::table('employee_attendences')->where('employee_official_id',$selectEmployee)->whereMonth('attendence_date',$selectMonth)->whereYear('attendence_date',$selectYear)->count();
        $absentCount        = DB::table('absent_employees')->where('employee_official_id',$selectEmployee)->whereMonth('absent_date',$selectMonth)->whereYear('absent_date',$selectYear)->count();
        $leaveCount         = DB::table('leave_employees')->where('employee_official_id',$selectEmployee)->whereMonth('leave_starting_date',$selectMonth)->whereYear('leave_starting_date',$selectYear)->count();

        if ($attendanceCount == 0 ) {
            if ($absentCount == 0 ) {
                if ($leaveCount == 0 ) {

                    return redirect('/employee/employee-month-select-form')->with('message','You select wrong month!!!');

                }
            }
        }

        if ($leaveCount != 0 ) {

            $leaveEmployee = DB::table('leave_employees')->where('employee_official_id',$selectEmployee)->whereMonth('leave_starting_date',$selectMonth)->whereYear('leave_starting_date',$selectYear)->select('intervals')->get();
            $intervals     = 0 ;

            foreach ($leaveEmployee as $leaveEmployee ){

                $intervals = $intervals + (int)$leaveEmployee->intervals;
            }

            return view('admin.attendence.select-employee-month-attendance-report',[
                'attendanceCount' => $attendanceCount,
                'absentCount'     => $absentCount,
                'intervals'       => $intervals,
                'selectEmployee'  => $selectEmployee,
                'month'           => $month
            ]);
        } else {

            $intervals = 0 ;

            return view('admin.attendence.select-employee-month-attendance-report',[
                'attendanceCount' => $attendanceCount,
                'absentCount'     => $absentCount,
                'intervals'       => $intervals,
                'selectEmployee'  => $selectEmployee,
                'month'           => $month
            ]);
        }

    }


    public function selectEmployeeMonthAttendanceReportDownload($selectEmployee,$month) {

        $selectMonth        = date("m", strtotime($month));
        $selectYear         = date("Y", strtotime($month));

        $employee           = DB::table('employee_job_infos')->join('employee_personal_infos','employee_job_infos.employee_id','=','employee_personal_infos.id')->where('employee_job_infos.employee_official_id',$selectEmployee)->select('employee_name','designation')->get();
        $attendanceCount    = DB::table('employee_attendences')->where('employee_official_id',$selectEmployee)->whereMonth('attendence_date',$selectMonth)->whereYear('attendence_date',$selectYear)->count();
        $absentCount        = DB::table('absent_employees')->where('employee_official_id',$selectEmployee)->whereMonth('absent_date',$selectMonth)->whereYear('absent_date',$selectYear)->count();
        $leaveCount         = DB::table('leave_employees')->where('employee_official_id',$selectEmployee)->whereMonth('leave_starting_date',$selectMonth)->whereYear('leave_starting_date',$selectYear)->count();

        if ($attendanceCount == 0 ) {
            if ($absentCount == 0 ) {
                if ($leaveCount == 0 ) {

                    return redirect('/employee/employee-month-select-form')->with('message','You select wrong month!!!');

                }
            }
        }

        if ($leaveCount != 0 ) {

            $leaveEmployee = DB::table('leave_employees')->where('employee_official_id',$selectEmployee)->whereMonth('leave_starting_date',$selectMonth)->whereYear('leave_starting_date',$selectYear)->select('intervals')->get();
            $intervals     = 0 ;

            foreach ($leaveEmployee as $leaveEmployee ){

                $intervals = $intervals + (int)$leaveEmployee->intervals;
            }

            $pdf = PDF::loadView('admin.attendence.select-employee-month-attendance-report-download',[
                'attendanceCount' => $attendanceCount,
                'absentCount'     => $absentCount,
                'intervals'       => $intervals,
                'selectEmployee'  => $selectEmployee,
                'employee'        => $employee,
                'month'           => $month
            ]);

            return $pdf->stream('employee_attendance_report');
        } else {

            $intervals = 0 ;

            $pdf = PDF::loadView('admin.attendence.select-employee-month-attendance-report-download',[
                'attendanceCount' => $attendanceCount,
                'absentCount'     => $absentCount,
                'intervals'       => $intervals,
                'selectEmployee'  => $selectEmployee,
                'employee'        => $employee,
                'month'           => $month
            ]);

            return $pdf->stream('employee_attendance_report');
        }

    }


        public function allEmployeesAttendanceSelectMonthForm() {
            return view('admin.attendence.all-employees-attendance-select-month-form');
        }


        public function allEmployeesAttendanceSelectMonth(Request $request) {

        $this->validate($request,[
            'month' => 'required'
        ]);

            $selectMonth = date('m',strtotime($request->month));
            $selectYear  = date('Y',strtotime($request->month));

            $attendanceCheck    = DB::table('employee_attendences')->whereMonth('attendence_date',$selectMonth)->whereYear('attendence_date',$selectYear)->count();
            $absentCheck        = DB::table('absent_employees')->whereMonth('absent_date',$selectMonth)->whereYear('absent_date',$selectYear)->count();
            $leaveCheck         = DB::table('leave_employees')->whereMonth('leave_starting_date',$selectMonth)->whereYear('leave_starting_date',$selectYear)->count();

            if ($attendanceCheck == 0 ) {
                if ($absentCheck == 0 ) {
                    if ($leaveCheck == 0 ) {

                        return redirect('/employee/all-employees-attendance-select-month-form')->with('message','You select wrong month!!!');

                    }
                }
            }

            if ($leaveCheck != 0 ){
               // return view('admin.attendence.all-employees-attendance-select-month');

               return   EmployeeJobInfo::leftJoin('employee_attendences as attendences', function ($link) {
                      $link->on('attendences.employee_official_id', '=', 'employee_job_infos.employee_official_id')
                          ->whereMonth('attendences.attendence_date',05)->whereYear('attendences.attendence_date',2018);
                  })
                   ->select('employee_job_infos.employee_official_id')->get();
                $allEmployees    = DB::table('employee_job_infos')->select('employee_official_id')->orderBy('id','asc')->get();
                $attendances     = DB::table('employee_attendences')->groupBy('employee_official_id')->whereMonth('attendence_date',$selectMonth)->whereYear('attendence_date',$selectYear)->select('employee_official_id',DB::raw('count(*) as totalAttendance'))->orderBy('id','asc')->get();
                return DB::table('employee_job_infos')->leftJoin('employee_attendences','employee_job_infos.employee_official_id','=','employee_attendences.employee_official_id')->whereMonth('employee_attendences.attendence_date',$selectMonth)->whereYear('employee_attendences.attendence_date',$selectYear)->get();
                $absents         = DB::table('absent_employees')->groupBy('employee_official_id')->whereMonth('absent_date',$currentMonth)->whereYear('absent_date',$currentYear)->select('employee_official_id',DB::raw('count(*) as totalAbsent'))->get();
                $nullAbsents     = DB::table('employee_job_infos')->leftJoin('absent_employees','employee_job_infos.employee_official_id','=','absent_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('absent_employees.employee_official_id')->get();
                $leaves          = DB::table('leave_employees')->groupBy('employee_official_id')->whereMonth('leave_starting_date',$currentMonth)->whereYear('leave_starting_date',$currentYear)->select('employee_official_id', DB::raw('SUM(intervals) as intervals'))->get();
                $nullLeaves      = DB::table('employee_job_infos')->leftJoin('leave_employees','employee_job_infos.employee_official_id','=','leave_employees.employee_official_id')->select('employee_job_infos.employee_official_id')->whereNull('leave_employees.employee_official_id')->get();

//                $friends = friend_list::rightJoin('users as u1', function($join) {
//                    $join->on('u1.id', '=', 'friend_lists.user_id2')
//                        ->where('friend_lists.user_id', '=', $id);
//                })
//                    ->where('friend_lists.user_id2','!=',$id)
//                    ->where('u1.id','!=',$id)
//                    ->orwhere('status',null)
//                    ->get();



                $pdf = PDF::loadView('admin.attendence.pdf-current-month-all-employees-monthly-attendance-report',[
                    'allEmployees'    =>  $allEmployees,
                    'attendances'     => $attendances,
                    'nullAttendances' => $nullAttendances,
                    'absents'         => $absents,
                    'nullAbsents'     => $nullAbsents,
                    'leaves'          => $leaves,
                    'nullLeaves'      => $nullLeaves,
                    'currentMonth'    => $currentMonth
                ]);

                return $pdf->stream('employees-monthlty-attandance-report.pdf');

            }
            else{

                return redirect('employee/all-employees-current-month-attendance-report')->with('message','No Employees are here.Please first add any employee');
            }
        }



}

