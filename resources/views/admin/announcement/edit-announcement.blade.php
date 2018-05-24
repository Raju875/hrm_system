@extends ("admin.master")

@section("title")
    <title>Edit Announcement</title>
@endsection

@section('body')
    <div class="col-md-8" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Edit Announcement</h2>
        <hr>
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Announcement</h3>
                @if(Session::has('message'))
                    <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
                @endif
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('/employee/update-announcement')}}" method="POST" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        {{--<label  class="col-sm-2 control-label">Emoloyee Id</label>--}}

                        @foreach($announcementId as $announcementId)
                        <div class="col-sm-10">
                            <input type="text" name="announcement_id" class="form-control" value="{{ $announcementId->id }}" readonly >
                        </div>
                    </div>
                    <div class="form-group">
                        <?php date_default_timezone_set('Asia/Dhaka')?>
                        <label  class="col-sm-2 control-label">Submitted Date</label>

                        <div class="col-sm-10">
                            <input type="date" class="form-control"  name="submitted_date" maxlength="50" value="{{ date("Y-m-d") }}" readonly>
                            <span style="color: #c41c41">{{ $errors->has('submitted_date') ? $errors->first('submitted_date') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Title</label>

                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control"  value="{{ $announcementId->title }}">
                            <span>{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control"  value="{{ $announcementId->description }}">
                            <span>{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                        </div>
                    </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Publication Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="publication_status">
                            @if( $announcementId->publication_status==1)
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            @else
                                <option value="0">Unpublished</option>
                                <option value="1">Published</option>
                            @endif
                            <span>{{ $errors->has('publication_status') ? $errors->first('publication_status') : ' ' }}</span>
                        </select>
                    </div>
                </div>
                    @endforeach
                </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" name="btn" class="btn btn-info btn-block">Update Announcement</button>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    </form>
    </div>
    <div class="control-sidebar-bg"></div>
    </div>
    </div>
@endsection
