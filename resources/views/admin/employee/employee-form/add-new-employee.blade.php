@extends ("admin.master")

@section("title")
    <title>Employee Personal Info</title>
@endsection

@section('body')
    <div class="col-md-8" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Add New Employee</h2>
        <hr>
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Personal Info</h3>
                @if(Session::has('message'))
                <h3 class="text text-center text-success">{{ Session::get('message') }}</h3>
            @endif
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('/employee/save-employee-info')}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Emoloyee Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="employee_name" class="form-control"  placeholder="Employee Name">
                            <span style="color: red">{{ $errors->has('employee_name') ? $errors->first('employee_name') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Father Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="father_name" class="form-control"  placeholder="Father Name">
                            <span style="color: red">{{ $errors->has('father_name') ? $errors->first('father_name') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Mother Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="mother_name" class="form-control"  placeholder="Mother Name">
                            <span style="color: red">{{ $errors->has('mother_name') ? $errors->first('mother_name') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Date OF Birth</label>

                        <div class="col-sm-10">
                            <input type="date" name="date_of_birth" class="form-control">
                            <span style="color: red">{{ $errors->has('date_of_birth') ? $errors->first('date_of_birth') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Phone No</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone_no" class="form-control" placeholder="Phone No">
                            <span style="color: red">{{ $errors->has('phone_no') ? $errors->first('phone_no') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <span style="color: red">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">National Id No</label>

                        <div class="col-sm-9">
                            <input type="number" name="national_id_no" class="form-control" placeholder="National Id No">
                            <span style="color: red">{{ $errors->has('national_id_no') ? $errors->first('national_id_no') : ' ' }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Present Address</label>

                        <div class="col-sm-9">
                            <textarea name="present_address" class="form-control" placeholder="Employee Present Address" rows="10" cols="80"></textarea>
                            <span style="color: red">{{ $errors->has('present_address') ? $errors->first('present_address') : ' ' }}</span>
                        </div>
                    </div>

                    {{--for single file input--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 control-label">Curriculam Vitae</label>--}}

                        {{--<div class="col-sm-9">--}}
                            {{--<input type="file"  id="cv" name="cv" onchange="previewImage(event)" />--}}
                            {{--<div> <img src="image.png" width="250px" height="200px" id="cvField" > </div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Curriculam Vitae</label>

                        <div class="col-sm-9">
                            <input type="file" name="cv" >
                            <span style="color: red">{{ $errors->has('cv') ? $errors->first('cv') : ' ' }}</span>
                            {{--<div id="previewCv"></div>--}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" accept="image/*"><br>
                            <span style="color: red">{{ $errors->has('photo') ? $errors->first('photo') : ' ' }}</span>
                            <div id="previewPhoto"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Job Info</h3>

                        <h3 class="text text-center text-success"></h3>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Official Id</label>
                        <div class="col-sm-10">
                            <input type="text" name="employee_official_id" class="form-control" placeholder="Employee Official Id">
                            <span style="color: red">{{ $errors->has('employee_official_id') ? $errors->first('employee_official_id') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Official Email Address</label>
                        <div class="col-sm-10">
                            <input type="email" name="official_email" class="form-control" placeholder="Official Email Address">
                            <span style="color: red">{{ $errors->has('official_email') ? $errors->first('official_email') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Official Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="official_password" class="form-control" >
                            <span style="color: red">{{ $errors->has('official_password') ? $errors->first('official_password') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Official Phone No</label>
                        <div class="col-sm-10">
                            <input type="number" name="official_phone_no" class="form-control" placeholder="Official Phone No">
                            <span style="color: red">{{ $errors->has('official_phone_no') ? $errors->first('official_phone_no') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Designation</label>
                        <div class="col-sm-10">
                            <input type="text" name="designation" class="form-control" placeholder="Designation">
                            <span style="color: red">{{ $errors->has('designation') ? $errors->first('designation') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Salary</label>
                        <div class="col-sm-10">
                            <input type="number" name="salary" class="form-control" placeholder="Salary">
                            <span style="color: red">{{ $errors->has('salary') ? $errors->first('salary') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2  control-label">Publication Status</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="publication_status" required>
                             <option>---Select Publication Status---</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                            <span style="color: red">{{ $errors->has('publication_status') ? $errors->first('publication_status') : ' ' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" name="btn" class="btn btn-info btn-block">Save Employee Info</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

            </form>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <script>//for PHOTO
        function previewImages() {

            var $preview = $('#previewPhoto').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {

                if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                    return alert(file.name +" is not an image");
                } // else...

                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append($("<img/>", {src:this.result, height:100}));
                });

                reader.readAsDataURL(file);

            }

        }

        $('#photo').on("change", previewImages);
    </script>
@endsection
