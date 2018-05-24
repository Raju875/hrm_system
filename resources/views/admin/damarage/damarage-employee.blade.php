@extends('admin.master')

@section('body')

    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center"> {{ date('F') }}: Damarage Details</h2>
        <h3 class="box-title text-center"> Employee Official Id :  {{ $damarageEmployee  }} </h3>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ $damarageEmployee  }} : Damarage Details</h3>
                            @if($message = Session::get('message'))
                                <h3 class="text text-success text-center">{{ $message }}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sl = 1 ?>
                                @foreach($damarageInfos as $damarageInfo)
                                <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $damarageInfo->date }}</td>
                                    <td>{{ $damarageInfo->amount }}</td>
                                    <td>{{ $damarageInfo->reason }}</td>
                                </tr>
                                    <?php $sl++?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>

        <div class="control-sidebar-bg"></div>
    </div>

    @endsection