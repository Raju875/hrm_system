@extends ("admin.master")

@section("title")
    <title>Leave Employees</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Leave Employees List</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Leave Employees List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Employee Official Id</th>
                                    <th>Application Date</th>
                                    <th>Leave Starting Date</th>
                                    <th>Leave Ending Date</th>
                                    <th>Intervals</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count =1 ?>
                                @foreach($querryByMonth as $querryByMonth)

                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $querryByMonth->employee_official_id }}</td>
                                        <td>{{ $querryByMonth->submitted_date }}</td>
                                        <td>{{ $querryByMonth->leave_starting_date }}</td>
                                        <td>{{ $querryByMonth->leave_ending_date }}</td>
                                        <td>{{ $querryByMonth->intervals }}</td>
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
