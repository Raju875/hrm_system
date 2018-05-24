@extends ("admin.master")

@section("title")
    <title>Manage Employee</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Pending Advance Salary Request</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Pending Request</h3>
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
                                    <th>Application Time</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count =1 ?>
                                @foreach($pendingAdvanceSalaries as $pendingAdvanceSalary)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $pendingAdvanceSalary->employee_official_id }}</td>
                                        <td>{{ $pendingAdvanceSalary->date }}</td>
                                        <td>{{ $pendingAdvanceSalary->time }}</td>
                                        <td>{{ $pendingAdvanceSalary->amount }}</td>
                                        <td>{{ $pendingAdvanceSalary->reason }}</td>
                                        <td>
                                            <a href="{{ url('/payroll/approve-advance-salary-request/'. $pendingAdvanceSalary->employee_official_id) }}" onclick="return confirm('Are you sure to approve employee advance salary request!!!')" class="btn btn-success btn-xs" title="approve">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </a>
                                            <a href="{{ url('/payroll/reject-advance-salary-request/'. $pendingAdvanceSalary->employee_official_id) }}" onclick="return confirm('Are you sure to reject employee leave request!!!')" class="btn btn-danger btn-xs" title="reject">
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
