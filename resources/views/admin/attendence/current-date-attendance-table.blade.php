@extends('admin.master')

@section('body')

    <div class="col-md-12" style="margin:50px 0px 0px 100px">
        @if($message = Session::get('message1'))
            <h1 class="text-center text-success">{{ $message }}</h1>
        @endif @if($message = Session::get('message1'))
            <h1 class="text-center text-success">{{ $message }}</h1>
        @endif
        <h2 class="box-title text-center">Employee Daily Attendence Table</h2>
        <h3 class="box-title text-center">Date : <u>{{ date('Y-m-d') }} </u></h3>
        <hr>
        {{--<h4 class="box-title text-center">{{ $presentEmployees->attendence_date }}</h4>--}}
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-11">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Present Employees List : <span style="color: #291eee"><span style="color: #ec03bb">{{ $attendanceCount }} </span>  employees present out of <span style="color: #ec03bb">{{ $employeesCount }}</span></span></h3>
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
                                    <th>Attendance Time</th>
                                </tr>
                                </thead>
                                <?php $sl=1?>

                                @if($attendanceCount==0)
                                    <tr>
                                        <td></td>
                                        <td><h4 style="color: #d20529">all employees absent yet !!!</h4></td>
                                    </tr>
                                    @else
                                @foreach($presentEmployees as $presentEmployees)
                                                    <tbody>

                                                    <tr>
                                                        <td>{{ $sl }}</td>
                                                        <td>{{ $presentEmployees->employee_official_id }}</td>
                                                        <td>{{ $presentEmployees->attendence_time }}</td>
                                                    </tr>
                                                    </tbody>
                                                    <?php $sl++?>
                                @endforeach
                                    @endif
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
                            <h3 class="box-title">Absent Employees List<span style="color: #291eee">:  @if($attendanceCount==0)<span style="color: #ec03bb">{{ $employeesCount }}</span> @else<span style="color: #ec03bb">{{ $absenceCount }}</span>@endif  employees absent out of <span style="color: #ec03bb">{{ $employeesCount }}</span></h3>
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

                                @foreach($absentEmployees as $absentEmployees)

                                    <tbody>
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $absentEmployees->employee_official_id }}</td>
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