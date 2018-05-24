@extends ("admin.master")

@section("title")
    <title>Announcement Form</title>
@endsection

@section('body')
    <div class="col-md-11" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Announcement Form</h2>
        <hr>
        @if($message = Session::get('message'))
            <h3 class="text text-success text-center">{{ $message }}</h3>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
<br>
<br><!-- /.box-header -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form role="form" method="post" action="{{ url('/employee/submit-announcement') }}">

                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <?php date_default_timezone_set('Asia/Dhaka')?>
                                                <label for="name"> Date:</label>
                                                <input type="date" class="form-control"  name="submitted_date" maxlength="50" value="{{ date("Y-m-d") }}" readonly>
                                                <span style="color: #c41c41">{{ $errors->has('submitted_date') ? $errors->first('submitted_date') : ' ' }}</span>
                                            </div>

                                            <label for="name"> Title</label>
                                            <div class="col-sm-6 form-group">
                                                <input type="text" class="form-control"  name="title"  maxlength="50"  >
                                                <span style="color: #c41c41">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label for="name"> Describe:</label>
                                                <textarea class="form-control" type="textarea"  name="description"  placeholder="Write here... " maxlength="6000" rows="7"></textarea>
                                                <span style="color: #c41c41">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label for="name"> Publication Status:</label>
                                                <select class="form-control" name="publication_status" required>
                                                    <option>---Select Publication Status---</option>
                                                    <option value="1">Published</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                                <span style="color: red">{{ $errors->has('publication_status') ? $errors->first('publication_status') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnContactUs">Post It! </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                                </div>
                            </div>
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
