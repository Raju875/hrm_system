<?php

namespace App\Http\Controllers;

use App\Damarage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DamarageController extends Controller
{
    public function damarageForm(){

        $publishedEmployees = DB::table('employee_job_infos')->where('publication_status',1)->select('employee_official_id')->get();

        return view('admin.damarage.damarage-form',[
            'publishedEmployees' => $publishedEmployees
        ]);
    }


    public function saveEmployeeDamarage(Request $request){

        $this->validate($request,[

            'date' => 'required',
            'employee_official_id' => 'required',
            'amount' => 'required',
            'reason' => 'required'
        ]);

        $damarage = new Damarage();

        $damarage->date = $request->date;
        $damarage->employee_official_id = $request->employee_official_id;
        $damarage->amount = $request->amount;
        $damarage->reason = $request->reason;

        $damarage->save();

        return redirect('/damarage/damarage-form')->with('message','Damarage form submitted successfully') ;

    }


    public function selectDamarageEmployee(){

        $currentMonth = date('m');

        $damarageCount = DB::table('damarages')->whereMonth('date',$currentMonth)->count();

        if ($damarageCount != 0){

            $damarageEmployees = DB::table('damarages')->select('employee_official_id')->distinct()->get();

            return view('admin.damarage.select-damarage-employee',[

                'damarageEmployees' => $damarageEmployees
            ]);
        } else {

            return redirect('/damarage/empty-damarage')->with('message',date('F Y').' : no employee is here');
        }

    }


    public function emptyDamarageEmployee(){

        return view('admin.damarage.empty-damarage');
    }


    public function viewDamarageEmployee(Request $request){

        $damarageEmployee = $request->employee_official_id;

       $damarageInfos = DB::table('damarages')->where('employee_official_id',$request->employee_official_id)->orderBy('id','desc')->get();

        return view('admin.damarage.damarage-employee',[

            'damarageInfos' => $damarageInfos,
            'damarageEmployee' => $damarageEmployee
        ]);
    }
}
