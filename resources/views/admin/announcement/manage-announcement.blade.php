@extends ("admin.master")

@section("title")
    <title>Manage Announcement</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Manage Announcement</h2>
        <hr>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Announcements List</h3>
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
                                    <th>Id</th>
                                    <th>Submitted Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Publication Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <?php $sl=1 ?>
                                @foreach($announcements as $announcement)
                                    <tbody>
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $announcement->id }}</td>
                                        <td>{{ $announcement->submitted_date }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->description }}</td>
                                        <td>
                                            @if($announcement->publication_status == 1)
                                                {{'Published'}}
                                            @else
                                                {{ 'Unpublished' }}
                                            @endif
                                        </td>

                                        <td>
                                            {{--<a href="{{ url('/employee/employee-job-info-details/') }}" class="btn btn-info btn-xs" title="dtails">--}}
                                                {{--<span class="glyphicon glyphicon-zoom-in"></span>--}}
                                            {{--</a>--}}
                                            @if($announcement->publication_status == 1)
                                                <a href="{{ url('/employee/unpublished-announcement/'.$announcement->id) }}" class="btn btn-success btn-xs" title="published">
                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                </a>
                                            @else
                                                <a href="{{ url('/employee/published-announcement/'.$announcement->id) }}" class="btn btn-warning btn-xs" title="unpublished">
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                </a>
                                            @endif

                                            <a href="{{ url('/employee/edit-announcement/'.$announcement->id) }}" class="btn btn-primary btn-xs" title="edit">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a href="{{ url('/employee/delete-announcement/'.$announcement->id) }}" onclick="return confirm('Are you sure to delete it !!!')" class="btn btn-primary btn-xs" title="delete">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $sl++ ?>
                                    </tbody>
                                @endforeach
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
