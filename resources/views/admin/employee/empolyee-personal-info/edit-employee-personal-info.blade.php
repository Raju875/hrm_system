@extends ("admin.master")

@section("title")
    <title>Edit Employee Personal Info</title>
@endsection

@section('body')
    <div class="col-md-8" style="margin:50px 0px 0px 100px">
        <h2 class="box-title text-center">Edit Employee</h2>
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
            <form class="form-horizontal" action="{{ url('/employee/update-employee-personal-info')}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Emoloyee Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="employee_name" class="form-control"  value="{{ $employeeById->employee_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Emoloyee Id</label>

                        <div class="col-sm-10">
                            <input type="text" name="employee_id" class="form-control" value="{{ $employeeById->id }}" readonly >
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Father Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="father_name" class="form-control"  value="{{ $employeeById->father_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Mother Name</label>

                        <div class="col-sm-10">
                            <input type="text" name="mother_name" class="form-control"  value="{{ $employeeById->mother_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Date OF Birth</label>

                        <div class="col-sm-10">
                            <input type="date" name="date_of_birth" class="form-control" value="{{ $employeeById->date_of_birth }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Phone No</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone_no" class="form-control" value="{{ $employeeById->phone_no }}">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label" >Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" value="{{ $employeeById->email }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">National Id No</label>

                        <div class="col-sm-9">
                            <input type="number" name="national_id_no" class="form-control" value="{{ $employeeById->national_id_no }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Present Address</label>

                        <div class="col-sm-9">
                            <textarea name="present_address" class="form-control" placeholder="Employee Present Address" rows="10" cols="80">{{ $employeeById->present_address }}</textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Curriculam Vitae</label>

                        <div class="col-sm-9">
                            <input type="file" name="cv" >
                            <span style="color: red">{{ $errors->has('cv') ? $errors->first('cv') : ' ' }}</span>
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
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Publication Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="publication_status">
                                @if( $employeeById->publication_status==1)
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                                    @else
                                    <option value="0">Unpublished</option>
                                    <option value="1">Published</option>
                                    @endif
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" name="btn" class="btn btn-info btn-block">Update Employee Personal Info</button>
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
