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


        </div>

    </div>

@endsection