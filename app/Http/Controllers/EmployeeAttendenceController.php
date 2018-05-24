<?php

namespace App\Http\Controllers;

use App\AbsentEmployee;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EmployeeAttendence;
use PDF;


class EmployeeAttendenceController extends Controller
{

    public function userDailyAttendenceSheet(){
        return view('user.attendence.daily-attendence-form');
    }


    public function dailyAttendenceSubmission(Request $request)
    {

        $this->validate($request, [
            'employee_official_id' => 'required',
            'attendence_date' => 'required',
            'attendence_time' => 'required',
            'attendence' => 'required',
        ]);

        $employeeById = $request->employee_official_id;
        $employeeAttendenceDate = $request->attendence_date;

         $count1 = DB::table('employee_attendences')->where('employee_official_id',$employeeById)->get()->count();

            if($count1==0){

                $employeeAttendence = new EmployeeAttendence();

                $employeeAttendence->employee_official_id = $request->employee_official_id;
                $employeeAttendence->attendence_date = $request->attendence_date;
                $employeeAttendence->attendence_time = $request->attendence_time;
                $employeeAttendence->attendence = $request->attendence;

                $employeeAttendence->save();

                  $countAbsentRowsByDate =  DB::table('absent_employees')->where('absent_date',$employeeAttendenceDate)->count();

                  if ( $countAbsentRowsByDate ==  0 ) {

                    $employeeJobInfos = DB::table('employee_job_infos')->get();

                    foreach ($employeeJobInfos as $employeeJobInfo){

                        if ( $employeeById != $employeeJobInfo->employee_official_id ){

                          $absentEmployee = new AbsentEmployee();

                          $absentEmployee->employee_official_id = $employeeJobInfo->employee_official_id;
                          $absentEmployee->absent_date = $employeeAttendenceDate;

                          $absentEmployee->save();

                        }
                    }

                  } else {

                      $employeeAttendenceInfos = DB::table('employee_attendences')->where('attendence_date',$employeeAttendenceDate)->get();

                      $absentEmployees = DB::table('absent_employees')->where('absent_date',$employeeAttendenceDate)->get();

                      foreach ($employeeAttendenceInfos as $employeeAttendenceInfo){

                          foreach ($absentEmployees as $absentEmployee){

                              if ($employeeAttendenceInfo->employee_official_id == $absentEmployee->employee_official_id){

                                  DB::table('absent_employees')->where('id',$absentEmployee->id)->delete();
                              }
                          }
                      }
                  }


                return redirect('/user/daily-attendence-sheet')->with('message', 'Attendence submitted successfully');
            }

            else{

                $count2  = DB::table('employee_attendences')->where('attendence_date',$employeeAttendenceDate)->get()->count();

                if ( $count2==0 ){

                    $employeeAttendence = new EmployeeAttendence();

                    $employeeAttendence->employee_official_id = $request->employee_official_id;
                    $employeeAttendence->attendence_date = $request->attendence_date;
                    $employeeAttendence->attendence_time = $request->attendence_time;
                    $employeeAttendence->attendence = $request->attendence;
                    $employeeAttendence->save();


                        $employeeJobInfos = DB::table('employee_job_infos')->get();

                        foreach ($employeeJobInfos as $employeeJobInfo){

                            if ( $employeeById != $employeeJobInfo->employee_official_id ){

                                $absentEmployee = new AbsentEmployee();

                                $absentEmployee->employee_official_id = $employeeJobInfo->employee_official_id;
                                $absentEmployee->absent_date = $employeeAttendenceDate;

                                $absentEmployee->save();
                            }
                        }

                    return redirect('/user/daily-attendence-sheet')->with('message', 'Attendance submitted successfully');

                    } else {

                   $attendenceEmployeeByDate = DB::table('employee_attendences')->where('attendence_date',$employeeAttendenceDate)->get();


                    foreach ($attendenceEmployeeByDate as $attendenceEmployeeByDate) {

                        if ($employeeById == $attendenceEmployeeByDate->employee_official_id) {

                            return redirect('/user/daily-attendence-sheet')->with('message1', 'Today you already submitted your attendance!!!');

                        }
                    }

                       $employeeAttendence = new EmployeeAttendence();

                       $employeeAttendence->employee_official_id = $request->employee_official_id;
                       $employeeAttendence->attendence_date = $request->attendence_date;
                       $employeeAttendence->attendence_time = $request->attendence_time;
                       $employeeAttendence->attendence = $request->attendence;

                       $employeeAttendence->save();

                      $employeeAbsentInfoByDate = DB::table('absent_employees')->where('absent_date',$employeeAttendenceDate)->get();

                        foreach ( $employeeAbsentInfoByDate as $employeeAbsentInfoByDate){

                                if ( $employeeById == $employeeAbsentInfoByDate->employee_official_id ){

                                    DB::table('absent_employees')->where('employee_official_id',$employeeById)->delete();
                                }
                            }

                    return redirect('/user/daily-attendence-sheet')->with('message', 'Attendance submitted successfully');
                }

            }
    }


    public function monthlyAttendenceReport(){

        $employeeOfficialId =  Session::get('validUserOfficialId');

        $currentMonth = date('m');

        $presentDates = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->get();


        $employeeAttendOffice = 0 ;

        foreach ($presentDates as $presentDate ){

            if ($employeeOfficialId == $presentDate->employee_official_id){

                $employeeAttendOffice++;
            }
        } //attend count

        $absentDates = DB::table('absent_employees')->whereMonth('absent_date',$currentMonth)->get();


        $employeeAbsentOffice = 0 ;

        foreach ($absentDates as $absentDate ){

            if ($employeeOfficialId == $absentDate->employee_official_id){

                $employeeAbsentOffice++;
            }
        } //absent count

        $leaveEmployeeInfoByDate = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->get();

        $intervals=0;

        foreach ($leaveEmployeeInfoByDate as $leaveEmployeeInfoByDate){

            if ($employeeOfficialId == $absentDate->employee_official_id){

                $intervals++;
            }

        }
        return view('user.attendence.monthly-attandence-report',[
            'employeeAttendOffice' => $employeeAttendOffice,
            'employeeAbsentOffice' => $employeeAbsentOffice,
            'employeeOfficialId' => $employeeOfficialId,
            'intervals' => $intervals
        ]);
    }


    public function userMonthlyAttendanceReportDownload(){


        $employeeOfficialId = Session::get('validUserOfficialId');

        $currentMonth = date('m');

        $presentDates = DB::table('employee_attendences')->whereMonth('attendence_date',$currentMonth)->get();


        $employeeAttendOffice = 0 ;

        foreach ($presentDates as $presentDate ){

            if ($employeeOfficialId == $presentDate->employee_official_id){

                $employeeAttendOffice++;
            }
        } //attend count

        $absentDates = DB::table('absent_employees')->whereMonth('absent_date',$currentMonth)->get();


        $employeeAbsentOffice = 0 ;

        foreach ($absentDates as $absentDate ){

            if ($employeeOfficialId == $absentDate->employee_official_id){

                $employeeAbsentOffice++;
            }
        } //absent count

        $leaveEmployeeInfoByDate = DB::table('leave_employees')->whereMonth('submitted_date',$currentMonth)->get();

        $intervals=0;

        foreach ($leaveEmployeeInfoByDate as $leaveEmployeeInfoByDate){

            if ($employeeOfficialId == $absentDate->employee_official_id){

                $intervals++;
            }

        }

        $pdf = PDF::loadView('user.attendence.pdf-monthly-attendence-report',[
            'employeeAttendOffice' => $employeeAttendOffice,
            'employeeAbsentOffice' => $employeeAbsentOffice,
            'employeeOfficialId' => $employeeOfficialId,
            'intervals' => $intervals
        ]);

        return $pdf->stream('monthly-attandance-report.pdf');
    }

}
