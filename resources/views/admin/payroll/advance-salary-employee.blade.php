@extends ("admin.master")

@section("title")
    <title>Leave Employees</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Advance Salary Employee </h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Employee Official Id : {{ $employee }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Employee Official Id</th>
                                    <th>Application Date</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count =1 ?>
                                @foreach($advanceEmplouees as $advanceEmplouees)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $advanceEmplouees->employee_official_id }}</td>
                                        <td>{{ $advanceEmplouees->application_date }}</td>
                                        <td>{{ $advanceEmplouees->amount }}</td>
                                        <td>{{ $advanceEmplouees->reason }}</td>
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
