@extends('admin.master')

@section('body')

    <section class="content">
        <div class="row">
            <div class="col-md-">
                <div class="box">
                    <br>
                    <br>
                    <div class="box-header with-border">
                        <h3 class="box-title">Salary Sheet</h3>
                    </div>
                    <br>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 12px">Sl</th>
                                <th style="width: 100px">Employee Official ID</th>
                                <th style="width: 100px">Designation</th>
                                <th style="width: 100px">Basic Salary</th>
                                <th style="width: 100px">Working Day</th>
                                <th style="width: 100px">Attendance</th>
                                <th style="width: 100px">Absent</th>
                                <th style="width: 100px">Leave</th>
                                <th style="width: 100px">Insurance</th>
                                <th style="width: 100px">Advance Salary</th>
                                <th style="width: 100px">Damarage</th>
                                <th style="width: 100px">Gross Salary</th>
                            </tr>

                            {{--@foreach($employeeJobInfos as $employeeJobInfo)--}}

                                {{--@foreach($employeeAttendance as $employeeAttendance)--}}

                                    {{--@if($employeeJobInfo->employee_official_id == $employeeAttendance->employee_official_id)--}}

                                        {{--@foreach($employeeAbsent as $employeeAbsent)--}}

                                            {{--@if($employeeJobInfo->employee_official_id == $employeeAbsent->employee_official_id)--}}

                                                {{--@foreach($leaveEmployees as $leaveEmployee)--}}

                                                    {{--@if($employeeJobInfo->employee_official_id == $leaveEmployee->employee_official_id)--}}

                                                        {{--@foreach($damarages as $damarage)--}}

                                                            {{--@if($employeeJobInfo->employee_official_id == $damarage->employee_official_id)--}}



                            {{--<tr>--}}
                             {{--<td>{{ $employeeJobInfo->employee_official_id }}</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                             {{--<td>Demo</td>--}}
                            {{--</tr>--}}
                                            {{--@endif--}}
                                                  {{--@endforeach--}}
                                            {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                            {{--@endforeach--}}
                                            {{--@endforeach--}}
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>

    @endsection