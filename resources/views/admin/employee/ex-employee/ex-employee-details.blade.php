@extends ("admin.master")

@section("title")
    <title>EX Employee Details</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Details Of EX Employee</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">EX Employee Information</h3>
                            <h3 class="text text-success text-center"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th class="col-sm-3">Employee Id</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Official Id</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->employee_official_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Name</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->employee_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Father Name</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->father_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Mother Name</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->mother_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Date Of Birth</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->date_of_birth }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Phone No</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->phone_no }}
                                        </td>
                                    </tr><tr>
                                        <th class="col-sm-3">Email</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">National Id No</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->national_id_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Present Address</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->present_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Id</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->employee_official_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Email</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->official_email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Official Password</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->official_password }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Designation</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->designation }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Salary</th>
                                        <td class="col-sm-9">
                                            {{ $exEmployeeById->salary }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Publication Status</th>
                                        <td class="col-sm-9">
                                            @if( $exEmployeeById->publication_status == 1 )
                                                {{'Published'}}
                                            @else
                                                {{ 'Unpublished' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee CV</th>
                                        <td class="col-sm-9">
                                            @foreach($exEmployeeCvById as $cv)
                                                <img src="{{ asset($cv->cv) }}" class="image-responsive" style="width: 213px; height: 300px " alt="Employee CV">
                                                <br/>
                                                <br/>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Photo</th>
                                        <td class="col-sm-9">
                                            @foreach($exEmployeePhotoById as $photo)
                                                <img src="{{ asset($photo->photo) }}" class="image-responsive" style="width: 213px; height: 300px" alt="Employee Photo"/>
                                                <br/>
                                                <br/>
                                            @endforeach
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
