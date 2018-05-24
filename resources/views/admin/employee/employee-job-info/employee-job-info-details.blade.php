@extends ("admin.master")

@section("title")
    <title>Employee Information</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Employee Information</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Employee Job Information</h3>
                            <h3 class="text text-success text-center"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th class="col-sm-3">Employee Id</th>
                                        <td class="col-sm-9">
                                            {{ $employeePersonalById->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Name</th>
                                        <td class="col-sm-9">
                                            {{ $employeePersonalById->employee_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Official Id</th>
                                        <td class="col-sm-9">
                                            {{ $employeeJobById->employee_official_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Email</th>
                                        <td class="col-sm-9">
                                            {{ $employeeJobById->official_email }}
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<th class="col-sm-3">Official Password</th>--}}
                                        {{--<td class="col-sm-9">--}}
                                            {{--{{ $decryptEmployeePassword }}--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <th class="col-sm-3">Official Phone No</th>
                                        <td class="col-sm-9">
                                            {{ $employeeJobById->official_phone_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Designation</th>
                                        <td class="col-sm-9">
                                            {{$employeeJobById->designation }}
                                        </td>
                                    </tr><tr>
                                        <th class="col-sm-3">Salary</th>
                                        <td class="col-sm-9">
                                            {{ $employeeJobById->salary }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Publication Status</th>
                                        <td class="col-sm-9">
                                            @if($employeeJobById->publication_status == 1)
                                                {{'Published'}}
                                            @else
                                                {{ 'Unpublished' }}
                                            @endif
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
