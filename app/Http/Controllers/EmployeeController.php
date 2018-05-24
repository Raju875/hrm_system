<?php

namespace App\Http\Controllers;
use App\AbsentEmployee;
use App\TemporaryAbsentEmployee;
use App\EmployeeCv;
use App\EmployeeJobInfo;
use App\EmployeePersonalInfo;
use App\EmployeePhoto;
use App\ExEmployee;
use App\ExEmployeeCv;
use App\ExEmployeePhoto;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function addNewEmployee()
    {
        return view('admin.employee.employee-form.add-new-employee');
    }

    public function saveEmployeeInfo(Request $request)
    {

        $this->validate($request, [
            'employee_name'        => 'required|regex:/^[\pL\s\-]+$/u',
            'father_name'          => 'required|regex:/^[\pL\s\-]+$/u',
            'mother_name'          => 'required|regex:/^[\pL\s\-]+$/u',
            'date_of_birth'        => 'required',
            'phone_no'             => 'required|size:11|regex:/(01)[0-9]{9}/',
            'email'                => 'required|email|unique:employee_personal_infos,email',
            'national_id_no'       => 'required|size:17|regex:/[0-9]/',
            'present_address'      => 'required',
            'publication_status'   => 'required',

        ]);

        $employeePersonalInfo = new EmployeePersonalInfo();

        $employeePersonalInfo->employee_name      = $request->employee_name;
        $employeePersonalInfo->father_name        = $request->father_name;
        $employeePersonalInfo->mother_name        = $request->mother_name;
        $employeePersonalInfo->date_of_birth      = $request->date_of_birth;
        $employeePersonalInfo->phone_no           = $request->phone_no;
        $employeePersonalInfo->email              = $request->email;
        $employeePersonalInfo->national_id_no     = $request->national_id_no;
        $employeePersonalInfo->present_address    = $request->present_address;
        $employeePersonalInfo->publication_status = $request->publication_status;

        $employeePersonalInfo->save();

        $employeeId = $employeePersonalInfo->id;

        $this->validate($request, [

              'employee_official_id'    => 'required|unique:employee_job_infos,employee_official_id',
              'official_email'          => 'required|email|unique:employee_job_infos,official_email',
              'official_password'       => 'required',
              'official_phone_no'       => 'required|size:11|regex:/(01)[0-9]{9}/',
              'designation'             => 'required',
              'salary'                  =>'required',
              'publication_status'      => 'required',
        ]);


        $employeeJobInfo = new EmployeeJobInfo();

        $employeeJobInfo->employee_id           = $employeeId;
        $employeeJobInfo->employee_official_id  = $request->employee_official_id;
        $employeeJobInfo->official_email        = $request->official_email;
        $employeeJobInfo->official_password     = bcrypt($request->official_password);
        $employeeJobInfo->official_phone_no     = $request->official_phone_no;
        $employeeJobInfo->designation           = $request->designation;
        $employeeJobInfo->salary                = $request->salary;
        $employeeJobInfo->publication_status    = $request->publication_status;
        $employeeJobInfo->save();


            $cvName     = $request->file('cv')->getClientOriginalName();
            $directory  = 'employeeFiles/cv/';
            $cvUrl      = $directory . $cvName;

            Input::file('cv')->move($directory);

            $cv = new EmployeeCv();

            $cv->employee_id = $employeeId;
            $cv->cv          = $cvUrl;
            $cv->save();


        $this->validate($request, [
        'photo' => 'required',
        ]);

            $photoName = $request->file('photo')->getClientOriginalName();
            $directory = 'employeeFiles/photo/';
            $photoUrl  = $directory . $photoName;

            Input::file('photo')->move($photoUrl);

            $photo = new EmployeePhoto();

            $photo->employee_id = $employeeId;
            $photo->photo       = $photoUrl;
            $photo->save();


          $absentEmployee = new AbsentEmployee();

          date_default_timezone_set('Asia/Dhaka');
          $absentEmployee->employee_official_id  = $employeeJobInfo->employee_official_id;
          $absentEmployee->absent_date           = date('Y-m-d');

          $absentEmployee->save();

        return redirect('/employee/add-new-employee')->with('message', 'Employee info saved  successfully :)');
    }


    public function manageEmployeePersonalInfo()
    {
        $employees = DB::table('employee_personal_infos')->join('employee_job_infos', 'employee_personal_infos.id', '=', 'employee_job_infos.employee_id')->select('employee_personal_infos.*', 'employee_job_infos.*')->orderBy('employee_personal_infos.id', 'desc')->get();

        return view('admin.employee.empolyee-personal-info.manage-employee-personal-info', [
                'employees'  => $employees
        ]);
    }


    public function employeePersonalInfoDetails($employee_id)
    {

        $employeeById      = DB::table('employee_personal_infos')->where('id', $employee_id)->first();
        $employeeCvById    = DB::table('employee_cvs')->where('employee_id', $employee_id)->get();
        $employeePhotoById = DB::table('employee_photos')->where('employee_id', $employee_id)->get();

        return view('admin.employee.empolyee-personal-info.employee-personal-info-details', [
            'employeeById'      => $employeeById,
            'employeeCvById'    => $employeeCvById,
            'employeePhotoById' => $employeePhotoById
        ]);
    }


    public function unpublishedEmployeePersonalInfo($employee_id)
    {
        DB::table('employee_personal_infos')->where('id', $employee_id)->update(['publication_status' => 0]);
        DB::table('employee_job_infos')->where('employee_id', $employee_id)->update(['publication_status' => 0]);

        return redirect('/employee/manage-employee-personal-info')->with('message', 'Unpublished employee publication status successfully');
    }


    public function publishedEmployeePersonalInfo($employee_id)
    {
        DB::table('employee_personal_infos')->where('id', $employee_id)->update(['publication_status' => 1]);
        DB::table('employee_job_infos')->where('employee_id', $employee_id)->update(['publication_status' => 1]);

        return redirect('/employee/manage-employee-personal-info')->with('message', 'Published employee publication status successfully');
    }


    public function editEmployeePersonalInfo($employee_id)
    {
        $employeeById   = DB::table('employee_personal_infos')->where('id', $employee_id)->first();
        $cvById         = DB::table('employee_cvs')->where('employee_id', $employee_id)->get();
        $cvByIdCount    = DB::table('employee_cvs')->where('employee_id', $employee_id)->get()->count();
        $photoById      = DB::table('employee_photos')->where('employee_id', $employee_id)->get();
        $photoByIdCount = DB::table('employee_photos')->where('employee_id', $employee_id)->get()->count();

        return view('admin.employee.empolyee-personal-info.edit-employee-personal-info', [
            'employeeById'    => $employeeById,
            'cvById'          => $cvById,
            'photoById'       => $photoById,
            'cvByIdCount'     => $cvByIdCount,
            'photoByIdCount'  => $photoByIdCount
        ]);
    }


    public function updateEmployeePersonalInfo(Request $request) //164-206
    {
      //  return $request->all();

       /* $this->validate($request, [
            'employee_name'      => 'required|regex:/^[\pL\s\-]+$/u',
            'father_name'        => 'required|regex:/^[\pL\s\-]+$/u',
            'mother_name'        => 'required|regex:/^[\pL\s\-]+$/u',
            'date_of_birth'      => 'required',
            'phone_no'           => 'required|size:11|regex:/(01)[0-9]{9}/',
            'email'              => 'required|email|unique:employee_personal_infos,email',
            'national_id_no'     => 'required|size:17|regex:/[0-9]/',
            'present_address'    => 'required',
            'cv'                 => 'required',
            'photo'              => 'required',
            'publication_status' => 'required',

        ]);*/

//     DB::table('employee_personal_infos')->where('id',$request->employee_id)->select('id')->update([
//
//         'employee_name'       =>  $request->employee_name,
//         'father_name'         =>  $request->father_name,
//         'mother_name'         =>  $request->mother_name,
//         'date_of_birth'       =>  $request->date_of_birth,
//         'phone_no'            =>  $request->phone_no,
//         'email'               =>  $request->email,
//         'national_id_no'      =>  $request->national_id_no,
//         'present_address'     =>  $request->present_address,
//         'publication_status'  =>  $request->publication_status
//
//
//     ]);


     // $oldUrl =  DB::table('employee_cvs')->where('employee_id',$request->employee_id)->select('cv')->get();

      $newFileName = $request->file('cv')->getClientOriginalName();
      $directory = 'employeeFiles/cv/';
      $newUrl = $directory.$newFileName;

      Input::file('cv')->move($directory);

        $cvName     = $request->file('cv')->getClientOriginalName();
        $directory  = 'employeeFiles/cv/';
        $cvUrl      = $directory . $cvName;

        Input::file('cv')->move($directory);

      DB::table('employee_cvs')->where('employee_id',$request->employee_id)->update([
          'cv' => $cvUrl
      ]);

      //Storage::delete($oldUrl);

        return 'done';


        Input::file('cv')->move($directory);

        $cv = EmployeeCv::find($request->employee_id);
        $cv->cv = $cvUrl;

        $cv->update();


        $employeePhoto = $request->file('photo');

            $photoName  = $employeePhoto->getClientOriginalName();
            $directory  = 'employeeFiles/photo/';
            $photoUrl   = $directory . $photoName;
            Input::file('photo')->move($directory);

            $photo = EmployeePhoto::find($request->employee_id);
            $photo->photo = $photoUrl;

            $photo->update();


        return redirect('/employee/manage-employee-personal-info')->with('message','Update  employee personal info successfully :)');
    }


    public function moveEmployeeFromPersonalInfo($employee_id)
    {

        $employee       = DB::table('employee_job_infos')->join('employee_personal_infos','employee_job_infos.employee_id','=','employee_personal_infos.id')->where('employee_id',$employee_id)->select('employee_personal_infos.*','employee_job_infos.*')->get();
        $employeeCvs    = DB::table('employee_cvs')->where('employee_id', $employee_id)->get();
        $employeePhotos = DB::table('employee_photos')->where('employee_id', $employee_id)->get();

        foreach ($employee as $employee) {

            $exEmployee = new ExEmployee();

            $exEmployee->employee_official_id  = $employee->employee_official_id;
            $exEmployee->employee_name         = $employee->employee_name;
            $exEmployee->father_name           = $employee->father_name;
            $exEmployee->mother_name           = $employee->mother_name;
            $exEmployee->date_of_birth         = $employee->date_of_birth;
            $exEmployee->phone_no              = $employee->phone_no;
            $exEmployee->email                 = $employee->email;
            $exEmployee->national_id_no        = $employee->national_id_no;
            $exEmployee->present_address       = $employee->present_address;
            $exEmployee->official_email        = $employee->official_email;
            $exEmployee->official_password     = $employee->official_password;
            $exEmployee->official_password     = $employee->official_password;
            $exEmployee->official_phone_no     = $employee->official_phone_no;
            $exEmployee->designation           = $employee->designation;
            $exEmployee->salary                = $employee->salary;
            $exEmployee->publication_status    = $employee->publication_status;

            $exEmployee->save();
        }

        foreach ($employeeCvs as $cv){

            $exEmployeeCv = new ExEmployeeCv();

            $exEmployeeCv->ex_employee_id = $employee->id;
            $exEmployeeCv->cv             = $cv->cv;

            $exEmployeeCv->save();
        }

        foreach ($employeePhotos as $photo){

            $exEmployeePhoto = new ExEmployeePhoto();

            $exEmployeePhoto->ex_employee_id = $employee->id;
            $exEmployeePhoto->photo = $photo->photo;

            $exEmployeePhoto->save();
        }


        DB::table('employee_personal_infos')->where('id', $employee_id)-> delete();
        DB::table('employee_job_infos')->where('employee_id', $employee_id)->delete();
        DB::table('employee_cvs')->where('employee_id', $employee_id)->delete();
        DB::table('employee_photos')->where('employee_id', $employee_id)->delete();

        return redirect('/employee/manage-employee-personal-info/')->with('message','Employee move successfully');

    }


    public function manageEmployeeJobInfo()
    {
        $employees      = DB::table('employee_personal_infos')->join('employee_job_infos', 'employee_personal_infos.id', '=', 'employee_job_infos.employee_id')->select('employee_personal_infos.*', 'employee_job_infos.*')->orderBy('employee_personal_infos.id', 'desc')->get();
        $employeeCvs    = DB::table('employee_cvs')->get();
        $employeePhotos = DB::table('employee_photos')->get();

        return view('admin.employee.employee-job-info.manage-employee-job-info', [
            'employees'      => $employees,
            'employeeCvs'    => $employeeCvs,
            'employeePhotos' => $employeePhotos
        ]);
    }


    public function employeeJobInfoDetails($employee_id)
    {
        //return $employee_id;
        //return EmployeeJobInfo::find($employee_id);

        $employeeJobById      = DB::table('employee_job_infos')->where('employee_id', $employee_id)->first();
        $employeePersonalById = DB::table('employee_personal_infos')->where('id', $employee_id)->first();

        return view('admin.employee.employee-job-info.employee-job-info-details', [
            'employeeJobById'      => $employeeJobById,
            'employeePersonalById' => $employeePersonalById

        ]);
    }


    public function unpublishedEmployeeJobInfo($employee_id)
    {
        DB::table('employee_personal_infos')->where('id', $employee_id)->update(['publication_status' => 0]);
        DB::table('employee_job_infos')->where('employee_id', $employee_id)->update(['publication_status' => 0]);

        return redirect('/employee/manage-employee-job-info')->with('message', 'Unpublished employee publication status successfully');
    }


    public function publishedEmployeeJobInfo($employee_id) //324-334
    {
        DB::table('employee_personal_infos')->where('id', $employee_id)->update(['publication_status' => 1]);
        DB::table('employee_job_infos')->where('employee_id', $employee_id)->update(['publication_status' => 1]);

        return redirect('/employee/manage-employee-job-info')->with('message', 'Published employee publication status successfully');
    }


    public function editEmployeeJobInfo($employee_id)
    {
        $employeeJobById      = DB::table('employee_job_infos')->where('employee_id', $employee_id)->first();
        $employeePersonalById = DB::table('employee_personal_infos')->where('id', $employeeJobById->employee_id)->first();

        return view('admin.employee.employee-job-info.edit-employee-job-info', [
            'employeeJobById'      => $employeeJobById,
            'employeePersonalById' => $employeePersonalById

        ]);
    }



    public function updateEmployeeJobInfo(Request $request)
    {
        //return $request->all();

        $this->validate($request, [

            'employee_official_id'  => 'required',
            'employee_name'         => 'required|regex:/^[\pL\s\-]+$/u',
            'official_email'        => 'required',
            'official_password'     => 'required',
            'official_phone_no'     => 'required|size:11|regex:/(01)[0-9]{9}/',
            'designation'           => 'required',
            'salary'                =>'required',
            'publication_status'    => 'required',
        ]);

        $employeeJobInfoById      = EmployeeJobInfo::where('employee_id',$request->employee_id)->first();
        $employeePersonalInfoById = EmployeePersonalInfo::where('id',$request->employee_id)->first();

        $employeePersonalInfoById->employee_name   =  $request->employee_name;
        $employeeJobInfoById->employee_official_id =  $request->employee_official_id;
        $employeeJobInfoById->official_email       =  $request->official_email;
        $employeeJobInfoById->official_password    =  $request->official_password;
        $employeeJobInfoById->official_phone_no    =  $request->official_phone_no;
        $employeeJobInfoById->designation          =  $request->designation;
        $employeeJobInfoById->salary               =  $request->salary;
        $employeeJobInfoById->publication_status   =  $request->publication_status;

        $employeeJobInfoById->save();

        $employeePersonalInfoById->save();


        return redirect('/employee/manage-employee-job-info')->with('message','Update  employee job info successfully :)');
    }


    public function moveEmployeeFromJobInfo($employee_id) //373-437
    {
        $employee       = DB::table('employee_job_infos')->join('employee_personal_infos','employee_job_infos.employee_id','=','employee_personal_infos.id')->where('employee_id',$employee_id)->select('employee_personal_infos.*','employee_job_infos.*')->get();
        $employeeCvs    = DB::table('employee_cvs')->where('employee_id', $employee_id)->get();
        $employeePhotos = DB::table('employee_photos')->where('employee_id', $employee_id)->get();

        $exEmployee     = new ExEmployee();

        foreach ($employee as $employee) {

            $exEmployee = new ExEmployee();

            $exEmployee->employee_official_id  = $employee->employee_official_id;
            $exEmployee->employee_name         = $employee->employee_name;
            $exEmployee->father_name           = $employee->father_name;
            $exEmployee->mother_name           = $employee->mother_name;
            $exEmployee->date_of_birth         = $employee->date_of_birth;
            $exEmployee->phone_no              = $employee->phone_no;
            $exEmployee->email                 = $employee->email;
            $exEmployee->national_id_no        = $employee->national_id_no;
            $exEmployee->present_address       = $employee->present_address;
            $exEmployee->official_email        = $employee->official_email;
            $exEmployee->official_password     = $employee->official_password;
            $exEmployee->official_password     = $employee->official_password;
            $exEmployee->official_phone_no     = $employee->official_phone_no;
            $exEmployee->designation           = $employee->designation;
            $exEmployee->salary                = $employee->salary;
            $exEmployee->publication_status    = $employee->publication_status;

           // $exEmployee->save();
        }

        foreach ($employeeCvs as $cv){
            $exEmployeeCv = new ExEmployeeCv();
            $exEmployeeCv -> ex_employee_id = $employeeJobInfo->id;
            $exEmployeeCv -> cv             = $cv->cv;
            $exEmployeeCv -> save();
        }

        foreach ($employeePhotos as $photo ) {
            $exEmployeePhoto = new ExEmployeePhoto();
            $exEmployeePhoto->ex_employee_id = $employeePersonalInfo->id;
            $exEmployeePhoto->photo          = $photo->photo;

            $exEmployeePhoto->save();
        }

        DB::table('employee_job_infos')->where('employee_id', $employee_id)->delete();
        DB::table('employee_personal_infos')->where('id', $employee_id)->delete();
        DB::table('employee_cvs')->where('employee_id', $employee_id)->delete();
        DB::table('employee_photos')->where('employee_id', $employee_id)->delete();

        return redirect('/employee/manage-employee-job-info/')->with('message','Employee moved successfully');

    }


    public function viewExEmployee()
    {
       $exEmployees = DB::table('ex_employees')->get();
        return view('admin.employee.ex-employee.view-ex-employee',[
            'exEmployees' => $exEmployees
            ]);
    }

    public function exEmployeeDetails($id){

        $exEmployeeById      = DB::table('ex_employees')->where('id',$id)->first();
        $exEmployeePhotoById = DB::table('ex_employee_photos')->where('ex_employee_id',$id)->get();
        $exEmployeeCvById    = DB::table('ex_employee_cvs')->where('ex_employee_id',$id)->get();

        return view('admin.employee.ex-employee.ex-employee-details',[
            'exEmployeeById'       => $exEmployeeById,
            'exEmployeePhotoById'  => $exEmployeePhotoById,
            'exEmployeeCvById'     => $exEmployeeCvById
        ]);
    }


    public function unpublishedExEmployeeInfo($id)
    {
        DB::table('ex_employees')->where('id', $id)->update(['publication_status' => 0]);

        return redirect('/employee/view-ex-employee')->with('message', 'Unpublished ex employee publication status successfully');
    }


    public function publishedExEmployeeInfo($id)
    {

        DB::table('ex_employees')->where('id', $id)->update(['publication_status' => 1]);

        return redirect('/employee/view-ex-employee')->with('message', 'Puublished ex employee publication status successfully');
    }


    public function deleteExEmployee($id)
    {
        DB::table('ex_employees')->where('id', $id)->delete();
        DB::table('ex_employee_photos')->where('ex_employee_id', $id)->delete();
        DB::table('ex_employee_cvs')->where('ex_employee_id', $id)->delete();

        return redirect('/employee/view-ex-employee')->with('message', 'Delete ex employee successfully');
    }


}
