
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>


<h2>Employee Monthly Attendance Report</h2>
<hr>
<br>
<br>
<table>
    <tr>
        <th>Employee Id</th>
        <td>{{ $employeeOfficialId }}</td>
    </tr>
    <tr>
        <?php $workingDays = $intervals+$employeeAttendOffice+$employeeAbsentOffice ?>
        <th>Working Days</th>
        <td>{{ $workingDays }}</td>
    </tr>
    <tr>
        <th>Present Days</th>
        <td>{{ $employeeAttendOffice }}</td>
    </tr>
    <tr>
        <th>Absent Days</th>
        <td>{{ $employeeAbsentOffice }}</td>
    </tr>
    <tr>
        <th>Leave Days</th>
        <td>{{ $intervals }}</td>
    </tr>
    <tr>
        <th>% of Presence</th>
        <td>
            <?php $result = (($intervals+$employeeAttendOffice)/$workingDays)*100 ?>
            {{ number_format((float)$result, 2, '.', '') .' %' }}
        </td>
    </tr>
    <tr>
        <th>% of Absence</th>
        <td>
            <?php $result = (($employeeAbsentOffice)/$workingDays)*100 ?>
            {{ number_format((float)$result, 2, '.', '') .' %' }}
        </td>
    </tr>
</table>
