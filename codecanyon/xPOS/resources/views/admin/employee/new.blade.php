@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>New User</b></h4>


            <form class="form-horizontal" role="form" id="userForm" enctype="multipart/form-data" data-parsley-validate
                  novalidate>
                {{csrf_field()}}
                <div id="image-preview" class="col-lg-offset-2">
                    <label for="image-upload" id="image-label">User Pic</label>
                    <input type="file" name="photo" id="image-upload"/>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Full Name*</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" required class="form-control" id="inputEmail3"
                               placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                    <div class="col-sm-7">
                        <input type="email" name="email" required parsley-type="email" class="form-control"
                               id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hori-pass1" class="col-sm-2 control-label">Password*</label>
                    <div class="col-sm-7">
                        <input id="hori-pass1" name="password" type="password" placeholder="Password" required
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hori-pass2" class="col-sm-2 control-label">Confirm Password *</label>
                    <div class="col-sm-7">
                        <input data-parsley-equalto="#hori-pass1" type="password" required placeholder="Password"
                               class="form-control" id="hori-pass2">
                    </div>
                </div>

                <div class="form-group">
                    <label for="webSite" class="col-sm-2 control-label">Type *</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="role">
                            <option value="2">Modarator</option>
                            <option value="3">Outlet Manager</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hori-pass2" class="col-sm-2 control-label">Phone *</label>
                    <div class="col-sm-7">
                        <input type="tel" name="phone" required placeholder="Phone number" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hori-pass2" class="col-sm-2 control-label">Additional Phone</label>
                    <div class="col-sm-7">
                        <input type="tel" name="additional_phone" placeholder="Additional Phone" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hori-pass2" class="col-sm-2 control-label">Address *</label>
                    <div class="col-sm-7">
                        <textarea required name="address" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Save
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {
            console.log('Ready............');
            $("#userForm").on('submit', function (e) {
                e.preventDefault();
                var userForm = $("#userForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/save-employee')}}', data, userForm);
            })
        })
    </script>
@endsection