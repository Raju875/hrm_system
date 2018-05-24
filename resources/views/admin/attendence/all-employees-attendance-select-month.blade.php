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

                                    <tr>
                                        <td></td>

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