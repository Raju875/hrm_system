@extends('user.master')

@section('content')

    <div class="right_col" role="main">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="box-title text-center"> {{ date('F Y') }} Attendance Report</h2>
                    <br>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Working Days </th>
                                <th class="column-title">Present Days </th>
                                <th class="column-title">Absent Days </th>
                                <th class="column-title">Leave Days </th>
                                <th class="column-title">% of Presence </th>
                                <th class="column-title">% of Absence </th>
                                <th class="column-title">Action </th>
                            </tr>
                            </thead>
                            <tr>
                                <?php $workingDays = $intervals+$employeeAttendOffice+$employeeAbsentOffice ?>
                                <td>{{ $workingDays }}</td>
                                <td>{{ $employeeAttendOffice }}</td>
                                <td>{{ $employeeAbsentOffice }}</td>
                                <td>{{ $intervals }}</td>
                                <td>{{ ($intervals+$employeeAttendOffice)/$workingDays*100}}</td>
                                <td>{{ ($employeeAbsentOffice/$workingDays)*100}}</td>
                                <td>
                                    <a href="{{ url('/pdf/user-monthly-attendance-report-download') }}" class="btn btn-primary btn-xs" title="pdf">
                                        <span class="glyphicon glyphicon-download"></span>
                                    </a>
                                </td>

                            </tr>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div


@endsection