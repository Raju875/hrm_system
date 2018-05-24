@extends ("admin.master")

@section("title")
    <title>Manage Employee</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Manage Resign Application</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Employee Resign Application Manage</h3>
                            @if($message = Session::get('message'))
                                <h3 class="text text-success text-center">{{ $message }}</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Employee Official Id</th>
                                    <th>Application Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count =1 ?>
                                @foreach($pendingResignEmployees as $pendingResignEmployee)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $pendingResignEmployee->employee_official_id }}</td>
                                        <td>{{ $pendingResignEmployee->submitted_date }}</td>
                                        <td>
                                            <a href="{{ url('/employee/pending-employee-resign-info-details/'. $pendingResignEmployee->employee_official_id) }}" class="btn btn-info btn-xs" title="dtails">
                                                <span class="glyphicon glyphicon-zoom-in"></span>
                                            </a>
                                            <a href="{{ url('/employee/approve-resign-application/'. $pendingResignEmployee->employee_official_id) }}" onclick="return confirm('Are you sure to confirm employee leave request!!!')" class="btn btn-success btn-xs" title="approve">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </a>
                                            <a href="{{ url('/employee/reject-resign-application/'. $pendingResignEmployee->employee_official_id) }}" onclick="return confirm('Are you sure to reject employee leave request!!!')" class="btn btn-danger btn-xs" title="reject">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                    <?php $count++ ?>
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
