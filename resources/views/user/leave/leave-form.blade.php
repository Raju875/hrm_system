@extends('user.master')

@section('content')

    <div class="right_col" role="main">

        <div class="col-md-8" style="margin:50px 0px 0px 100px">
            <h1 class="box-title text-center">Employee Leave Form</h1>
            <hr>
            <!-- Horizontal Form -->
            @if(Session::has('message'))
                <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" method="post" action="{{ url('/user/submit-leave-form') }}">

                           {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-12 form-group">
                                        <input type="hidden" class="form-control"  name="to_email" maxlength="50" value="alaminraju875@gmail.com" readonly>
                                        <span style="color: #c41c41">{{ $errors->has('to_email') ? $errors->first('to_email') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <?php date_default_timezone_set('Asia/Dhaka')?>
                                    <label for="name"> Date:</label>
                                        <input type="date" class="form-control"  name="submitted_date" maxlength="50" value="{{ date("Y-m-d") }}" readonly>
                                        <span style="color: #c41c41">{{ $errors->has('submitted_date') ? $errors->first('submitted_date') : ' ' }}</span>
                                </div>

                                <label for="name"> Employee Official Id:</label>
                                <div class="col-sm-6 form-group">
                                    <input type="text" class="form-control"  name="employee_official_id"  maxlength="50" value="{{ Session::get('validUserOfficialId') }}" readonly >
                                    <span style="color: #c41c41">{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="email"> Starting Date:</label>
                                    <input type="date" class="form-control"  name="leave_starting_date" maxlength="50">
                                    <span style="color: #c41c41">{{ $errors->has('leave_starting_date') ? $errors->first('leave_starting_date') : ' ' }}</span>

                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="email"> Ending Date:</label>
                                    <input type="date" class="form-control"  name="leave_ending_date" maxlength="50">
                                    <span style="color: #c41c41">{{ $errors->has('leave_ending_date') ? $errors->first('leave_ending_date') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="name"> Reason:</label>
                                    <textarea class="form-control" type="textarea"  name="reason"  placeholder="Write here to reason of leave of absence" maxlength="6000" rows="7"></textarea>
                                    <span style="color: #c41c41">{{ $errors->has('reason') ? $errors->first('reason') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnContactUs">Post It! </button>
                                </div>
                            </div>
                        </form>
                        <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                        <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection