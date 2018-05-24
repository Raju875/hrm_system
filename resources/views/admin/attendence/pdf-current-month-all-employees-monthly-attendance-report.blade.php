<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Attendance Report Current Month</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <?php date_default_timezone_set('Asia/Dhaka');?>
    <h2><strong>{{ date('F-Y') }}</strong> Employees Attendance Report</h2>
       <hr>
        <br>
    <table class="table table-bordered">
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
                        @else
                            <?php $zero = 0 ?>
                            @foreach($nullAttendances as $nullAttendance)
                                @if($nullAttendance->employee_official_id == $allEmployee->employee_official_id && $nullAttendance->employee_official_id != $attendance->employee_official_id )
                                    {{ $zero }}
                </td>
                @endif
                @endforeach
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
                        <?php $result = (($totalAttendance + $inLeave )*100 )/($zero + $notPresent + $inLeave )   ?>
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
            </tr>
            <?php $i++;?>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

