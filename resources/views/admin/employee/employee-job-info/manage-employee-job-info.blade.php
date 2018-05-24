@extends ("admin.master")

@section("title")
    <title>Manage Employee</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 50px">
        <h2 class="box-title text-center">Manage Employee</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-md-">
                    <div class="box">
                        <br>
                        <br>
                        <div class="box-header with-border">
                            <div class="box-header">
                                <h3 class="box-title">Employee Job Information</h3>
                                @if($message = Session::get('message'))
                                    <h3 class="text text-success text-center">{{ $message }}</h3>
                                @endif
                            </div>
                        </div>
                        <br>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 12px">Sl</th>
                                    <th>SL Id</th>
                                    <th>Employee Official Id</th>
                                    <th>Employee Name</th>
                                    <th>Official Email</th>
                                    {{--<th>Official Password</th>--}}
                                    <th>Official Phone No</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Publication Status</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <?php $sl=1 ?>
                                    @foreach($employees as $employee)
                                        <tbody>
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->employee_official_id }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                            <td>{{ $employee->official_email }}</td>
                                            {{--<td>{{ $employee->official_password }}</td>--}}
                                            <td>{{ $employee->official_phone_no }}</td>
                                            <td>{{ $employee->designation }}</td>
                                            <td>{{ $employee->salary }}</td>
                                            <td>
                                                @if($employee->publication_status == 1)
                                                    {{'Published'}}
                                                @else
                                                    {{ 'Unpublished' }}
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ url('/employee/employee-job-info-details/'. $employee->employee_id) }}" class="btn btn-info btn-xs" title="dtails">
                                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                                </a>
                                                @if($employee->publication_status == 1)
                                                    <a href="{{ url('/employee/unpublished-employee-job-info/'. $employee->employee_id ) }}" class="btn btn-success btn-xs" title="published">
                                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                                    </a>
                                                @else
                                                    <a href="{{ url('/employee/published-employee-job-info/'. $employee->employee_id) }}" class="btn btn-warning btn-xs" title="unpublished">
                                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                                    </a>
                                                @endif

                                                <a href="{{ url('/employee/edit-employee-job-info/'. $employee->employee_id) }}" class="btn btn-primary btn-xs" title="edit">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                                <a href="{{ url('/employee/move-employee-from-job-info/'. $employee->employee_id) }}" onclick="return confirm('Are you sure to move it to ex-employee!!!')" class="btn btn-primary btn-xs" title="delete">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $sl++ ?>
                                        </tbody>
                                    @endforeach
                                </tr>
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

        <div class="control-sidebar-bg"></div>
    </div>


@endsection
