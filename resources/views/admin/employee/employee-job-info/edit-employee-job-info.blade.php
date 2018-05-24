@extends ("admin.master")

@section("title")
    <title>Edit Employee Job Info</title>
@endsection

@section('body')
    <div class="col-md-8" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Edit Employee</h2>
        <hr>
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Job Info</h3>
                @if(Session::has('message'))
                    <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
                @endif
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('/employee/update-employee-job-info')}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        {{--<label  class="col-sm-2 control-label">Emoloyee Id</label>--}}

                        <div class="col-sm-10">
                            <input type="hidden" name="employee_id" class="form-control" value="{{ $employeeJobById->employee_id }}" readonly >
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Emoloyee Official Id</label>

                        <div class="col-sm-10">
                            <input type="text" name="employee_official_id" class="form-control" value="{{ $employeeJobById->employee_official_id }}" readonly>
                            <span>{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Emoloyee Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="employee_name" class="form-control"  value="{{ $employeePersonalById->employee_name }}">
                            <span>{{ $errors->has('employee_name') ? $errors->first('employee_name') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Official Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="official_email" class="form-control"  value="{{ $employeeJobById->official_email }}" readonly>
                            <span>{{ $errors->has('official_email') ? $errors->first('official_email') : ' ' }}</span>
                        </div>
                    </div>
                    <label  class="col-sm-2 control-label">Official Password</label>

                        <div class="col-sm-10">
                            <input type="password" name="official_password" class="form-control"  value="{{ $employeeJobById->official_password }}">
                            <span>{{ $errors->has('official_password') ? $errors->first('offocial_password') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Official Phone No</label>

                        <div class="col-sm-10">
                            <input type="number" name="official_phone_no" class="form-control"  value="{{ $employeeJobById->official_phone_no }}">
                            <span>{{ $errors->has('official_phone_no') ? $errors->first('official_phone_no') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Designation</label>

                        <div class="col-sm-10">
                            <input type="text" name="designation" class="form-control" value="{{ $employeeJobById->designation }}">
                            <span>{{ $errors->has('designation') ? $errors->first('designation') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Salary</label>
                        <div class="col-sm-10">
                            <input type="number" name="salary" class="form-control" value="{{ $employeeJobById->salary }}">
                            <span>{{ $errors->has('salary') ? $errors->first('salary') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Publication Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="publication_status">
                                @if( $employeeJobById->publication_status==1)
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                @else
                                    <option value="0">Unpublished</option>
                                    <option value="1">Published</option>
                                @endif
                                    <span>{{ $errors->has('publication_status') ? $errors->first('publication_status') : ' ' }}</span>
                            </select>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" name="btn" class="btn btn-info btn-block">Update Employee Job Info</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>
    </div>
@endsection
