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
                                <h3 class="box-title">Employee Personal Information</h3>
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
                                    <th>SL No</th>
                                    <th>Employee Name</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Birth Date</th>
                                    <th>Phone No</th>
                                    <th>Email</th>
                                    <th>National Id No</th>
                                    <th>Present Address</th>
                                    <th>Publication Status</th>
                                    {{--<th>CV</th>--}}
                                    {{--<th>Photo</th>--}}
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <?php $count=1;?>
                                    @foreach($employees as $employee )
                                        <tbody>
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                            <td>{{ $employee->father_name }}</td>
                                            <td>{{ $employee->mother_name }}</td>
                                            <td>{{ $employee->date_of_birth }}</td>
                                            <td>{{ $employee->phone_no }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->national_id_no }}</td>
                                            <td>{{ $employee->present_address }}</td>
                                            <td>
                                                @if($employee->publication_status == 1)
                                                    {{'Published'}}
                                                @else
                                                    {{ 'Unpublished' }}
                                                @endif
                                            </td>
                                            {{--<td>--}}
                                            {{--@foreach($employeeCvs as $employeeCv)--}}
                                            {{--<img src="{{ asset($employeeCv->cv) }}" class="image-responsive" style="width: 50px;height: 50px" alt/>--}}
                                            {{--<br/>--}}
                                            {{--<br/>--}}
                                            {{--@endforeach--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                            {{--@foreach($employeePhotos as $employeePhoto)--}}
                                            {{--<img src="{{ asset($employeePhoto->photo) }}" class="image-responsive" style="width: 50px;height: 50px" alt/>--}}
                                            {{--<br/>--}}
                                            {{--<br/>--}}
                                            {{--@endforeach--}}
                                            {{--</td>--}}
                                            <td>
                                                <a href="{{ url('/employee/employee-personal-info-details/'.$employee->employee_id) }}" class="btn btn-info btn-xs" title="dtails">
                                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                                </a>
                                                @if($employee->publication_status == 1)
                                                    <a href="{{ url('/employee/unpublished-employee-personal-info/'.$employee->employee_id ) }}" class="btn btn-success btn-xs" title="published">
                                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                                    </a>
                                                @else
                                                    <a href="{{ url('/employee/published-employee-personal-info/'.$employee->employee_id) }}" class="btn btn-warning btn-xs" title="unpublished">
                                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                                    </a>
                                                @endif

                                                <a href="{{ url('/employee/edit-employee-personal-info/'.$employee->employee_id) }}" class="btn btn-primary btn-xs" title="edit">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                                <a href="{{ url('/employee/move-employee-from-personal-info/'.$employee->employee_id) }}" onclick="return confirm('Are you sure to move it to ex-employee!!!')" class="btn btn-primary btn-xs" title="delete">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <?php $count=$count+1 ?>
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
