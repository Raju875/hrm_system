{{--@extends('user.master')--}}

{{--@section('content')--}}

    {{--<div class="right_col" role="main">--}}

        {{--<div class="col-md-8" style="margin:50px 0px 0px 100px">--}}
            {{--<h1 class="box-title text-center">Employee Advance Salary Form</h1>--}}
            {{--<hr>--}}
            {{--<!-- Horizontal Form -->--}}
            {{--@if(Session::has('message'))--}}
                {{--<h3 class="text text-center text-success">{{ Session::get('message') }}</h3>--}}
            {{--@endif--}}
            {{--@if(Session::has('message1'))--}}
                {{--<h3 class="text text-center text-danger">{{ Session::get('message1') }}</h3>--}}
            {{--@endif--}}
            {{--<form class="form-horizontal" action="{{ url('/user/submit-advance-salary-form')}}" method="POST" enctype="multipart/form-data" >--}}
                {{--{{ csrf_field() }}--}}
                {{--<div class="box-body">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputPassword3" class="col-sm-2 control-label">Employee Official Id</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<select class="form-control" name="employee_official_id">--}}
                                {{--@foreach($publishedEmployeeOfficialId as $publishedEmployeeOfficialId)--}}
                                    {{--<option value="{{ $publishedEmployeeOfficialId->employee_official_id }}">{{ $publishedEmployeeOfficialId->employee_official_id }} </option>"--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<input type="text" class="form-control" name="employee_official_id" value="{{ Session::get('validUserOfficialId') }}" readonly>--}}
                            {{--<span>{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<?php date_default_timezone_set('Asia/Dhaka')?>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label" >Date</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="email" name="date" class="form-control" value="{{date("Y-m-d")}}" readonly >--}}
                        {{--</div>--}}
                        {{--<span>{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>--}}

                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">Time</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input  class="form-control" name="time" value=" {{ date('g:i a') }}" readonly>--}}
                        {{--</div>--}}
                        {{--<span>{{ $errors->has('time') ? $errors->first('time') : ' ' }}</span>--}}

                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">Amount</label>--}}

                        {{--<div class="col-sm-10">--}}
                            {{--<input type="number" min="0" name="amount" class="form-control">--}}
                            {{--<span style="color: red">{{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">Reason</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<textarea name="reason" class="form-control" placeholder="Write here... ..." rows="10" cols="80"></textarea>--}}
                            {{--<span style="color: red">{{ $errors->has('reason') ? $errors->first('reason') : ' ' }}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-2">--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<button type="submit" name="btn" class="btn btn-info btn-block">Save</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.box-body -->--}}
        {{--</div>--}}
        {{--</form>--}}

        {{--</div>--}}

    {{--</div>--}}

    {{--<script>--}}

        {{--function calculator(){--}}
            {{--alert(sum(15,20));--}}
        {{--}--}}

        {{--function sum(first,second){--}}
            {{--var result =  first +  second;--}}
            {{--return result;--}}
        {{--}--}}

    {{--</script>--}}


    {{--<script>--}}

        {{--calculator();--}}

    {{--</script>--}}

{{--<script>--}}

    {{--function calculator(){--}}
        {{--alert(sum(15,15));--}}
    {{--}--}}

    {{--function sum(first,second) {--}}
        {{--return first+second;--}}
    {{--}--}}

{{--</script>--}}

{{--<script>--}}
    {{--calculator();--}}
{{--</script>--}}

{{--@endsection--}}

<form action="{{ url('/file') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file">
    <input type="submit" name="btn">
</form>