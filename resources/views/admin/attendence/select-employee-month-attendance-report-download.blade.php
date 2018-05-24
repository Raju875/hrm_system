<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>Attendance Report</h2>

<table>
    <tr>
        <th>Employee Id</th>
        <td>{{ $selectEmployee }}</td>
    </tr>
    @foreach($employee as $employee)
    <tr>
        <th>Employee Name</th>
        <td>{{ $employee->employee_name }}</td>

    </tr>
    <tr>

        <th>Employee Designation</th>
        <td>{{ $employee->designation }}</td>
    </tr>
    @endforeach
    <tr>
        <th>Working Days</th>
        <?php $workingDays =$attendanceCount + $absentCount + $intervals ?>
        <td>{{ $workingDays }}</td>
    </tr>
    <tr>
        <th>Present Days</th>
        <td>{{ $attendanceCount }}</td>
    </tr>
    <tr>
        <th>Absent Days</th>
        <td>{{ $absentCount }}</td>
    </tr>
    <tr>
        <th>Leave Days</th>
        <td>{{ $intervals }}</td>
    </tr>
    <tr>
        <th>% of Presence</th>
        <?php $presence = (($attendanceCount+ $intervals )/$workingDays )*100 ?>
        <td>{{ number_format((float)$presence, 2, '.', '') }}</td>
    </tr>
    <tr>
        <th>% of Absence</th>
        <?php $absence = 100 - $presence ?>
        <td>{{ number_format((float)$absence, 2, '.', '') }}</td>
    </tr>
</table>

</body>
</html>