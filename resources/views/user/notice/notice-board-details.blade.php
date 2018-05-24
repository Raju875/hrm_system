@extends('user.master')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    @foreach($notice as $notice)
                    <h3>Notice :  <small >{{ $notice->submitted_date }}</small></h3>
                    <br>
                    <br>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Title :  <small>{{ $notice->title }}</small> </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                                {{ $notice->description }}
                            </p>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection