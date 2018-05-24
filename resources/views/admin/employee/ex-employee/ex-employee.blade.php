@extends ("admin.master")

@section("title")
    <title>EX Employee</title>
@endsection

@section('body')
    <div class="col-md-12" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">EX Employee</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-11">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">EX Employee Information</h3>
                            @if($message = Session::get('message'))
                                <h3 class="text-center text-success">{{ $message }}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Employee Designation</th>
                                    <th>Employee Phone No</th>
                                    <th>Employee Email</th>
                                    <th>Employee Photos</th>
                                    <th>Publication Status</th>
                                    {{--<th>CV</th>--}}
                                    {{--<th>Photo</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <?php $count=1;?>
                                @foreach($employees as $employee )
                                    <tbody>
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>{{ $employee->employee_name }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->phone_no }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->email }}</td>
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
                                                <a href="{{ url('/employee/unpublished-employee/'.$employee->employee_id ) }}" class="btn btn-success btn-xs" title="published">
                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                </a>
                                            @else
                                                <a href="{{ url('/employee/published-employee/'.$employee->employee_id) }}" class="btn btn-warning btn-xs" title="unpublished">
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                </a>
                                            @endif

                                            <a href="{{ url('/employee/edit-employee/'.$employee->employee_id) }}" class="btn btn-primary btn-xs" title="edit">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a href="{{ url('/product/product-delete/') }}" onclick="return confirm('Are you sure to delete it!!!')" class="btn btn-primary btn-xs" title="delete">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php $count=$count+1 ?>
                                @endforeach
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
