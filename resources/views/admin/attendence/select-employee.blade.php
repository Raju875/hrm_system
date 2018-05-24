@extends('admin.master')

@section('body')

    <div class="right_col" role="main">

        <div class="col-md-8" style="margin:50px 0px 0px 100px">
            <div class="box-header with-border">
                <h3 class="box-title"><u><strong>Select Employee</strong></u></h3>

                @if( $message = Session::get('message') )
                    <h3 class="text-centre text-warning"> {{ $message }} </h3>
                @endif

                <br>
            </div>
            <form action="{{ url('/employee/employee-select-current-month-attendance-report') }}" method="post">
                {{ csrf_field() }}
                <br>
                <div class="form-horizontal">
                    <select class="form-control" name="employee_official_id">
                        @foreach($publishedEmployees as $publishedEmployee)
                            <option value="{{ $publishedEmployee->employee_official_id }}">{{ $publishedEmployee->employee_official_id }} </option>"
                        @endforeach
                            <span>{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>
                    </select>

                </div>
                <br>

                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>

@endsection