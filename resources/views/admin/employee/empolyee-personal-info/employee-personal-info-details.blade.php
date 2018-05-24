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
                            <h3 class="box-title">Employee Personal Information</h3>
                            <h3 class="text text-success text-center"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th class="col-sm-3">Employee Id</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Name</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->employee_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Father Name</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->father_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Mother Name</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->mother_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Date Of Birth</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->date_of_birth }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Phone No</th>
                                        <td class="col-sm-9">
                                          {{$employeeById->phone_no }}
                                        </td>
                                    </tr><tr>
                                        <th class="col-sm-3">Email</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">National Id No</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->national_id_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Present Address</th>
                                        <td class="col-sm-9">
                                            {{ $employeeById->present_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Publication Status</th>
                                        <td class="col-sm-9">
                                            @if($employeeById->publication_status == 1)
                                                {{'Published'}}
                                            @else
                                                {{ 'Unpublished' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee CV</th>
                                        <td class="col-sm-9">
                                               @foreach($employeeCvById as $cv)
                                                 <img src="{{ asset($cv->cv) }}" class="image-responsive" style="width: 213px; height: 300px " alt="Employee CV">
                                                   <br/>
                                                   <br/>
                                                   @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-3">Employee Photos</th>
                                        <td class="col-sm-9">
                                            @foreach($employeePhotoById as $photo)
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
