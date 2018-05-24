@extends('admin.master')

@section('body')

    <div class="col-md-8" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Damarage Employee</h2>
        <hr>
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Damarage Form</h3>
                @if(Session::has('message'))
                    <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
                @endif
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('/damarage/save-employee-damarage')}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body">
                    <?php date_default_timezone_set('Asia/Dhaka')?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" class="form-control" value="{{date("Y-m-d")}}" readonly>
                        </div>
                        <span>{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>

                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Employee Official Id</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="employee_official_id">
                                @foreach($publishedEmployees as $publishedEmployee)
                                    <option value="{{ $publishedEmployee->employee_official_id }}">{{ $publishedEmployee->employee_official_id }} </option>"
                                @endforeach
                            </select>
                            <span>{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" name="amount" class="form-control" placeholder="TK">
                            <span style="color: red">{{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason</label>
                            <div class="col-sm-10">
                                <textarea name="reason" class="form-control" placeholder="Write here... ..." rows="10" cols="80"></textarea>
                                <span style="color: red">{{ $errors->has('reason') ? $errors->first('reason') : ' ' }}</span>
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" name="btn" class="btn btn-info btn-block">Save </button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

            </form>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>

    @endsection