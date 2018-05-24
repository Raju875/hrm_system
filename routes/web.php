<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/file','WelcomeController@file');
Route::get('/','WelcomeController@index');
Route::get('/dashboard','WelcomeController@dashboard');
Route::get('/employee/add-new-employee','EmployeeController@addNewEmployee');
Route::post('/employee/save-employee-info','EmployeeController@saveEmployeeInfo');



Route::get('/employee/manage-employee-personal-info','EmployeeController@manageEmployeePersonalInfo');
Route::get('/employee/employee-personal-info-details/{employee_id}','EmployeeController@employeePersonalInfoDetails');
Route::get('/employee/unpublished-employee-personal-info/{employee_id}','EmployeeController@unpublishedEmployeePersonalInfo');
Route::get('/employee/published-employee-personal-info/{employee_id}','EmployeeController@publishedEmployeePersonalInfo');
Route::get('/employee/edit-employee-personal-info/{employee_id}','EmployeeController@editEmployeePersonalInfo');
Route::post('/employee/update-employee-personal-info/','EmployeeController@updateEmployeePersonalInfo');
Route::get('/employee/move-employee-from-personal-info/{employee_id}','EmployeeController@moveEmployeeFromPersonalInfo');
//Employee Personal Info ( admin )


Route::get('/employee/manage-employee-job-info','EmployeeController@manageEmployeeJobInfo');
Route::get('/employee/employee-job-info-details/{employee_id}','EmployeeController@employeeJobInfoDetails');
Route::get('/employee/unpublished-employee-job-info/{employee_id}','EmployeeController@unpublishedEmployeeJobInfo');
Route::get('/employee/published-employee-job-info/{employee_id}','EmployeeController@publishedEmployeeJobInfo');
Route::get('/employee/edit-employee-job-info/{employee_id}','EmployeeController@editEmployeeJobInfo');
Route::post('/employee/update-employee-job-info','EmployeeController@updateEmployeeJobInfo');
Route::get('/employee/move-employee-from-job-info/{employee_id}','EmployeeController@moveEmployeeFromJobInfo');
//Employee job Info ( admin )


Route::get('/employee/view-ex-employee/','EmployeeController@viewExEmployee');
Route::get('/employee/ex-employee-details/{id}','EmployeeController@exEmployeeDetails');
Route::get('/employee/unpublished-ex-employee-info/{id}','EmployeeController@unpublishedExEmployeeInfo');
Route::get('/employee/published-ex-employee-info/{id}','EmployeeController@publishedExEmployeeInfo');
Route::get('/employee/delete-ex-employee/{id}','EmployeeController@deleteExEmployee');
//EX Employee Info ( admin )


Route::get('/employee/current-date','AttendenceController@currentDate');
Route::get('/employee/select-attendence-date','AttendenceController@selectAttendenceDate');
Route::post('/employee/daily-attendence-report','AttendenceController@dailyAttendenceReport');

Route::get('/employee/select-employee-for-current-month-attendance-report','AttendenceController@selectEmployeeForCurrentMonthAttendanceReport');
Route::post('/employee/employee-select-current-month-attendance-report','AttendenceController@employeeSelectCurrentMonthAttendanceReport');
Route::get('/employee/all-employees-current-month-attendance-report','AttendenceController@allEmployeesCurrentMonthAttendanceReport');

Route::get('/employee/employee-month-select-form','AttendenceController@employeeMonthSelectForm');
Route::post('/employee/select-employee-month-attendance-report','AttendenceController@selectEmployeeMonthAttendanceReport');
Route::get('/employee/all-employees-attendance-select-month-form','AttendenceController@allEmployeesAttendanceSelectMonthForm');
Route::post('/employee/all-employees-attendance-select-month','AttendenceController@allEmployeesAttendanceSelectMonth');

Route::get('/pdf/current-month-attendance-report-download/{employeeOfficialId}','AttendenceController@currentMonthAttendanceReportDownload');
Route::get('/pdf/all-employee-current-month-attendance-report-download','AttendenceController@allEmployeeCurrentMonthAttendanceReportDownload');
Route::get('/pdf/select-employee-month-attendance-report-download/{selectEmployee}/{month}','AttendenceController@selectEmployeeMonthAttendanceReportDownload');
//Employee attendence control ( admin )


Route::get('/employee/leave-approval-table','LeaveApprovalController@leaveApprovalTable');
Route::get('/employee/pending-employee-leave-info-details/{pendingEmployee}','LeaveApprovalController@pendingEmployeeLeaveInfoDetails');
Route::get('/employee/approve-leave-application/{pendingEmployee}','LeaveApprovalController@approveLeaveApplication');
Route::get('/employee/reject-leave-application/{pendingEmployee}','LeaveApprovalController@rejectLeaveApplication');
Route::get('/employee/current-month-leave-employees','LeaveApprovalController@currentMonthLeaveEmployees');
Route::get('/employee/select-month-leave-employees','LeaveApprovalController@selectMonthLeaveEmployees');
Route::post('/employee/select-month-for-leave-report','LeaveApprovalController@selectMonthForLeaveReport');
 //Employee leave controll (admin)


Route::get('/damarage/damarage-form','DamarageController@damarageForm');
Route::post('/damarage/save-employee-damarage','DamarageController@saveEmployeeDamarage');
Route::get('/damarage/select-damarage-employee','DamarageController@selectDamarageEmployee');
Route::post('/damarage/view-damarage-employee','DamarageController@viewDamarageEmployee');
Route::get('/damarage/empty-damarage','DamarageController@emptyDamarageEmployee');
//Employee damarage controll (admin)



Route::get('/employee/resign-approval-table','ResignApprovalController@resignApprovalTable');
Route::get('/employee/pending-employee-resign-info-details/{pendingEmployee}','ResignApprovalController@pendingEmployeeResignInfoDetails');
Route::get('/employee/approve-resign-application/{pendingEmployee}','ResignApprovalController@approveResignApplication');
Route::get('/employee/reject-resign-application/{pendingEmployee}','ResignApprovalController@rejectResignApplication');
//Employee resign controll (admin)


Route::get('/payroll/advance-salary-approval','PayrollController@advanceSalaryApproval');
Route::get('/payroll/approve-advance-salary-request/{pendingEmployee}','PayrollController@approveAdvanceSalaryRequest');
Route::get('/payroll/reject-advance-salary-request/{pendingEmployee}','PayrollController@rejectAdvanceSalaryRequest');
Route::get('/payroll/select-employee','PayrollController@selectEmployee');
Route::get('/payroll/empty-advance-salary','PayrollController@emptyAdvanceSalary');
Route::post('/payroll/view-advance-employee','PayrollController@viewAdvanceEmployees');
Route::get('/payroll/employee-salary-sheet','PayrollController@employeeSalarySheet');
//Employee payroll control(admin)


Route::get('/employee/post-announcement','AnnouncementController@announcement');
Route::post('/employee/submit-announcement','AnnouncementController@submitAnnouncement');
Route::get('/employee/manage-announcement','AnnouncementController@manageAnnouncement');
Route::get('/employee/unpublished-announcement/{announcementId}','AnnouncementController@unpublishedAnnouncement');
Route::get('/employee/published-announcement/{announcementId}','AnnouncementController@publishedAnnouncement');
Route::get('/employee/edit-announcement/{announcementId}','AnnouncementController@editAnnouncement');
Route::post('/employee/update-announcement','AnnouncementController@updateAnnouncement');
Route::get('/employee/delete-announcement/{announcementId}','AnnouncementController@deleteAnnouncement');
//Employee announcement controll (admin)


             //user

Route::get('/user/home','UserController@userHome');
Route::get('/user','UserController@userLoginForm');
Route::post('/user/userLoginCheck','UserController@userLoginCheck');
Route::get('/user/logout','UserController@userLogout');
//USER login ( user )

Route::get('/user/damage-notification-session','UserController@damageNotificationSession');


Route::get('/user/daily-attendence-sheet','EmployeeAttendenceController@userDailyAttendenceSheet');
Route::post('/user/daily-attendence-submission','EmployeeAttendenceController@dailyAttendenceSubmission');
Route::get('/usre/monthly-attendence-report','EmployeeAttendenceController@monthlyAttendenceReport');

Route::get('/pdf/user-monthly-attendance-report-download','EmployeeAttendenceController@userMonthlyAttendanceReportDownload');

//User Attendnce (user)


Route::get('/user/advance-salary-form','SalaryController@advanceSalaryForm');
Route::post('/user/submit-advance-salary-form','SalaryController@submitAdvanceSalaryForm');
//User Salary Cotrol (user)

Route::get('/user/leave-form','LeaveController@leaveForm');
Route::post('/user/submit-leave-form','LeaveController@submitLeaveForm');
//User Leave (user)


Route::get('/user/resign-form','ResignController@resignForm');
Route::post('/user/submit-resign-form','ResignController@submitResignForm');

//User Resign {user}

Route::get('/user/notice-board','NoticeController@noticeBoard');
Route::get('/user/notice-board-details/{id}','NoticeController@noticeBoardDetails');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
