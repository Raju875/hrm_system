@extends ("admin.master")

@section("title")
    <title>Pending Employee Resign Information Details</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Pending Employee Resign Information Details</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Pending Employee</h3>
                            <h3 class="text text-success text-center"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th class="col-sm-3">Employee Official Id</th>
                                        <td class="col-sm-9">
                                            {{ $pendingResignEmployee->employee_official_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Email</th>
                                        <td class="col-sm-9">
                                            {{ $jobEmployee->official_email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Phone No</th>
                                        <td class="col-sm-9">
                                            {{ $jobEmployee->official_phone_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Designation</th>
                                        <td class="col-sm-9">
                                            {{$jobEmployee->designation }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Application Submitted Date</th>
                                        <td class="col-sm-9">
                                            {{ $pendingResignEmployee->submitted_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Resigning Date</th>
                                        <td class="col-sm-9">
                                            {{ $pendingResignEmployee->resigning_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Reason</th>
                                        <td class="col-sm-9">
                                            {{ $pendingResignEmployee->reason }}
                                        </td>
                                    </tr>
                                </table>
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
