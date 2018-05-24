@extends('admin.master')

@section('body')

    <div class="right_col" role="main">

        <div class="col-md-8" style="margin:50px 0px 0px 100px">
            <div class="box-header with-border">
                <h3 class="box-title"><u><strong>Select Attendence Date</strong></u></h3>

                @if( $message = Session::get('message') )
                <h3 class="text-centre text-warning"> {{ $message }} </h3>
                @endif

                <br>
            </div>
            <form action="{{ url('/employee/daily-attendence-report') }}" method="post">
                {{ csrf_field() }}
                <br>
                <div class="form-horizontal">
                    <input type="date" class="form-control" name="attendence_date"  >
                    <span style="color: #ff6864">{{ $errors->has('attendence_date') ? $errors->first('attendence_date') : ' ' }}</span>
                </div>
                <br>

                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>

    @endsection