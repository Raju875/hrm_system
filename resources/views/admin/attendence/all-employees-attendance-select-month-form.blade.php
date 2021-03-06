@extends('admin.master')

@section('body')

    <div class="right_col" role="main">

        <div class="col-md-8" style="margin:50px 0px 0px 100px">
            <div class="box-header with-border">
                <h3 class="box-title"><u><strong>Select Month</strong></u></h3>
                <br>
                <br>
                @if( $message = Session::get('message') )
                    <h3 class="text-centre text-warning"> {{ $message }} </h3>
                @endif

                <br>
            </div>
            <form class="form-horizontal" action="{{ url('/employee/all-employees-attendance-select-month')}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Month</label>

                        <div class="col-sm-10">
                            <input type="month" name="month" class="form-control">
                            <span style="color: red">{{ $errors->has('month') ? $errors->first('month') : ' ' }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" name="btn" class="btn btn-info">Submit</button>
                    </div>
                </div>
        </div>
        <!-- /.box-body -->

        </form>

    </div>

    </div>

@endsection