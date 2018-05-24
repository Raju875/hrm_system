@extends('user.master')

@section('content')

    <div class="right_col" role="main">

        <div class="col-md-8" style="margin:50px 0px 0px 100px">
            <h1 class="box-title text-center">Daily attendence form</h1>
            <hr>
            <!-- Horizontal Form -->
            @if(Session::has('message'))
                <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
            @endif
            @if(Session::has('message1'))
                <h3 class="text text-center text-danger">{{ Session::get('message1') }}</h3>
            @endif
                <div class="box-header with-border">
                    <h3 class="box-title"><u><strong>Attendence form</strong></u></h3>
                    <br>
                </div>
            <form action="{{ url('/user/daily-attendence-submission') }}" method="post">
                {{ csrf_field() }}
                <div class="form-horizontal">
                    <label for="exampleInputEmail1">Employee Id</label>
                    <input type="text" class="form-control"  name="employee_official_id" value="{{ Session::get('validUserOfficialId') }}" readonly>
                    <span>{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>

                </div>
                <br>
                <?php date_default_timezone_set('Asia/Dhaka')?>
                <div class="form-horizontal">
                    <label for="exampleInputEmail1">Date</label>
                    <input  class="form-control" name="attendence_date" value="{{ date("Y-m-d") }}"  >

                </div>
                <br>
                <div class="form-horizontal">
                    <label for="exampleInputEmail1">Time</label>
                    <input  class="form-control" name="attendence_time" value=" {{ date('g:i a') }}" readonly>

                </div>
                <br>
                <div class="form-group">
                    <div class="radio">
                        <label><input type="radio" name="attendence" value="present">I am present</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="attendence" disabled>I am absent</label>
                    </div>
                    <div class="radio disabled">
                        <label><input type="radio" name="attendence" disabled>I am late</label>
                    </div>
                    <span style="color: #c41c41">{{ $errors->has('attendence') ? $errors->first('attendence') : ' ' }}</span>

                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

            </div>

    @endsection