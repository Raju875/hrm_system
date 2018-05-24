@extends('admin.master')

@section('body')

    <div class="col-md-12" style="margin:50px 0px 0px 100px">
        @if($message = Session::get('message1'))
            <h1 class="text-center text-success">{{ $message }}</h1>
        @endif @if($message = Session::get('message1'))
            <h1 class="text-center text-success">{{ $message }}</h1>
        @endif
        <h2 class="box-title text-center">Employee Daily Attendence Table</h2>
        <h3 class="box-title text-center">Date : <u>{{ $selectDate }} </u></h3>
        <hr>
        {{--<h4 class="box-title text-center">{{ $presentEmployees->attendence_date }}</h4>--}}
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-11">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Present Employees List : <span style="color: #6770ee"> {{ $presentEmployeesCount }} employees present out of {{ $jobEmployeesCount }}</span></h3>
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
                                    <th>Employee Official Id</th>
                                    <th>Employee Name</th>
                                    <th>Attendance Time</th>
                                    <th>Official Email</th>
                                    <th>Phone Number</th>
                                </tr>
                                </thead>
                                <?php $sl=1?>

                                @foreach($presentEmployeesByDate as $presentEmployeeByDate)

                                    @foreach($allJobEmployees as $allJobEmployee)

                                        @if($presentEmployeeByDate->employee_official_id == $allJobEmployee->employee_official_id)

                                            @foreach($allPersonalEmployees as $allPersonalEmployee )

                                                @if($allPersonalEmployee->id == $allJobEmployee->employee_id)
                                    <tbody>

                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $presentEmployeeByDate->employee_official_id }}</td>
                                        <td>{{ $allPersonalEmployee->employee_name }}</td>
                                        <td>{{ $presentEmployeeByDate->attendence_time }}</td>
                                        <td>{{ $allJobEmployee->official_email }}</td>
                                        <td>{{ $allJobEmployee->official_phone_no }}</td>
                                    </tr>
                                    </tbody>
                                                    <?php $sl++?>
                                        @endif
                                        @endforeach
                                        @endif
                                    @endforeach
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


    </div>

    <div class="col-md-12" style="margin:50px 0px 0px 100px">
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-11">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Absent Employees List<span style="color: #6770ee">: {{ $absentEmployeesCount }} employees absent out of {{ $jobEmployeesCount }}</span></h3>
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
                                    <th>Employee Official Id</th>
                                </tr>
                                </thead>

                                <?php $sl=1 ?>

                                @foreach($absentEmployees as $absentEmployee)

                                 <tbody>
                                    <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $absentEmployee->employee_official_id }}</td>
                                </tr>
                                                     <?php $sl++?>

                                @endforeach
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


    </div>

    @endsection