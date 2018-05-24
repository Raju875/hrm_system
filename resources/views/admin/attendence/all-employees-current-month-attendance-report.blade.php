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
                            <a href="{{ url('/pdf/all-employee-current-month-attendance-report-download/' ) }}" onclick="return confirm('Are you sure to grnerate pdf!!!')" class="btn btn-primary btn-xs" title="download">
                                Download <span class="glyphicon glyphicon-download"></span>
                            </a>
                            @if($message = Session::get('message'))
                                <h3 class="text text-danger text-center">{{ $message }}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Employee Id</th>
                                    <th>Present Days</th>
                                    <th>Absent Days</th>
                                    <th>Leave Days</th>
                                    <th>Working Days</th>
                                    <th>% of Presence</th>
                                    <th>% of Absence</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1?>
                                @foreach($allEmployees as $allEmployee )

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $allEmployee->employee_official_id }}</td>

                                        <td>
                                            @foreach($attendances as $attendance )
                                                @if($allEmployee->employee_official_id == $attendance->employee_official_id )
                                                    <?php
                                                    $totalAttendance = $attendance->totalAttendance;
                                                    $attendEmployee = $attendance->employee_official_id;
                                                    ?>
                                                    {{ $attendance->totalAttendance }}
                                                    <?php $zero = 0 ?>

                                        </td>

                                        @endif
                                        @endforeach

                                        <td>
                                            @foreach($absents as $absent )
                                                @if($allEmployee->employee_official_id == $absent->employee_official_id )
                                                    <?php
                                                    $notPresent = $absent->totalAbsent;
                                                    $absentEmployee = $absent->employee_official_id;
                                                    ?>
                                                    {{ $absent->totalAbsent }}
                                                @else
                                                    @foreach($nullAbsents as $nullAbsent )
                                                        @if($nullAbsent->employee_official_id == $allEmployee->employee_official_id && $nullAbsent->employee_official_id != $absent->employee_official_id )
                                                            {{ $nullAbsent->employee_official_id }}
                                        </td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach

                                        <td>
                                            @foreach($leaves as $leave )
                                                @if($allEmployee->employee_official_id == $leave->employee_official_id )
                                                    <?php
                                                    $inLeave = $leave->intervals;
                                                    $leaveEmployee = $leave->employee_official_id;
                                                    ?>
                                                    {{ $leave->intervals }}
                                                @else
                                                    @foreach($nullLeaves as $nullLeave )
                                                        @if($nullLeave->employee_official_id == $allEmployee->employee_official_id  )
                                                            {{ '0' }}
                                        </td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach

                                        <td>
                                            @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                {{ $totalAttendance + $notPresent + $inLeave  }}
                                            @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    {{ $zero + $notPresent + $inLeave  }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    {{  $totalAttendance + $zero + $inLeave  }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $totalAttendance + $notPresent + $zero  }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    {{  $zero + $zero + $inleave  }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $zero + $notPresent + $zero  }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $totalAttendance + $zero + $zero  }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $zero + $zero + $zero  }}
                                                @endif
                                        </td>
                                        <td>
                                            @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                <?php $result = (($totalAttendance + $inLeave )*100 )/($totalAttendance + $notPresent + $inLeave )  ?>
                                                {{ number_format((float)$result, 2, '.', '') .' %' }}
                                            @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($zero + $inLeave )*100 )/($zero + $notPresent + $inLeave )   ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($totalAttendance + $inLeave )*100 )/($totalAttendance + $zero + $inLeave ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($totalAttendance + $zero )*100 )/($totalAttendance + $notPresent + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($totalAttendance + $inLeave )*100 )/($zero + $zero + $inleave ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($zero + $zero )*100 )/($zero + $notPresent + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($totalAttendance + $zero )*100 )/($totalAttendance + $zero + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $zero .' %' }}
                                                @endif
                                        </td>
                                        <td>
                                            @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                <?php $result = (($notPresent )*100 )/($totalAttendance + $notPresent + $inLeave )  ?>
                                                {{ number_format((float)$result, 2, '.', '') .' %' }}
                                            @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($notPresent )*100 )/($zero + $notPresent + $inLeave )   ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($zero )*100 )/($totalAttendance + $zero + $inLeave ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($notPresent )*100 )/($totalAttendance + $notPresent + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id == $leaveEmployee  )
                                                    <?php $result = (($zero )*100 )/($zero + $zero + $inleave ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id == $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($notPresent )*100 )/($zero + $notPresent + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id == $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    <?php $result = (($zero )*100 )/($totalAttendance + $zero + $zero ) ?>
                                                    {{ number_format((float)$result, 2, '.', '') .' %' }}
                                                @endif
                                                @if($allEmployee->employee_official_id != $attendEmployee && $allEmployee->employee_official_id != $absentEmployee && $allEmployee->employee_official_id != $leaveEmployee  )
                                                    {{  $zero .' %' }}
                                                @endif
                                        </td>
                                    <td>
                                        <a href="{{ url('/pdf/current-month-attendance-report-download/'.$allEmployee->employee_official_id ) }}" onclick="return confirm('Are you sure to grnerate pdf!!!')" class="btn btn-primary btn-xs" title="download">
                                            <span class="glyphicon glyphicon-download"></span>
                                        </a>
                                    </td>

                                </tr>
                                <?php $i++;?>
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

        <div class="control-sidebar-bg"></div>
    </div>

@endsection