@extends('admin.master')

@section('body')

    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center"> {{ date('F Y') }} Attendance Report</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Attendance Report</h3>
                            @if($message = Session::get('message'))
                                <h3 class="text text-success text-center">{{ $message }}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Working Days</th>
                                    <th>Present Days</th>
                                    <th>Absent Days</th>
                                    <th>Leave Days</th>
                                    <th>% of Presence</th>
                                    <th>% of Absence</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                    <tbody>
                                    <tr>
                                        <?php $workingDays = $intervals+$employeeAttendOffice+$employeeAbsentOffice ?>
                                        <td>{{ $employeeOfficialId }}</td>
                                        <td>{{ $workingDays }}</td>
                                        <td>{{ $employeeAttendOffice }}</td>
                                        <td>{{ $employeeAbsentOffice }}</td>
                                        <td>{{ $intervals }}</td>
                                        <td>
                                            <?php $result = (($intervals+$employeeAttendOffice)/$workingDays)*100 ?>
                                            {{ number_format((float)$result, 2, '.', '') .' %' }}
                                        </td>
                                        <td>
                                            <?php $result = 100-$result ?>
                                            {{ number_format((float)$result, 2, '.', '') .' %' }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/pdf/current-month-attendance-report-download/'.$employeeOfficialId) }}" onclick="return confirm('Are you sure to grnerate pdf!!!')" class="btn btn-primary btn-xs" title="delete">
                                                <span class="glyphicon glyphicon-download"></span>
                                            </a>
                                        </td>

                                    </tr>
                                    </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>

        <div class="control-sidebar-bg"></div>
    </div>

@endsection