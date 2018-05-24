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
            <form action="{{ url('/damarage/view-damarage-employee') }}" method="post">
                {{ csrf_field() }}
                <br>
                <div class="form-horizontal">
                    <select class="form-control" name="employee_official_id">
                        @foreach($damarageEmployees as $damarageEmployee)
                            <option value="{{ $damarageEmployee->employee_official_id }}">{{ $damarageEmployee->employee_official_id }} </option>"
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