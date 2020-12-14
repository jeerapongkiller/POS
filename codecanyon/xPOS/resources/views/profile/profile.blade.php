@extends('layouts.app')

@section('title') Profile @endsection

@section('content')

    <?php $user = auth()->user(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h3>Profile</h3>
                <form class="form-horizontal" role="form" id="userForm" enctype="multipart/form-data" data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div id="image-preview" class="col-lg-offset-2" style="background-image: url('{{url($user->image != '' || $user->image != null ? $user->image : '/images/placeholder.png')}}')">
                        <label for="image-upload" id="image-label">User Pic</label>
                        <input type="file" name="photo" id="image-upload"/>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Full Name*</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" value="{{$user->name}}" required class="form-control" id="inputEmail3"
                                   placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                        <div class="col-sm-7">
                            <input type="email" name="email" value="{{$user->email}}" required parsley-type="email" class="form-control"
                                   id="inputEmail3" placeholder="Email">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-2 control-label">Phone *</label>
                        <div class="col-sm-7">
                            <input type="tel" name="phone" value="{{$user->phone}}" required placeholder="Phone number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-2 control-label">Additional Phone</label>
                        <div class="col-sm-7">
                            <input type="tel" name="additional_phone" value="{{$user->additional_phone}}" placeholder="Additional Phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-2 control-label">Address *</label>
                        <div class="col-sm-7">
                            <textarea required name="address" class="form-control" id="" cols="30" rows="5">{{$user->address}}</textarea>
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
                <button class="col-sm-offset-2 btn btn-link" data-toggle="modal" data-target="#myModal">Change password</button>

            </div>
        </div>
    </div>

    @include('profile.change-password')
@endsection

@section('extra-js')
    <script>
        $(document).ready(function(){
            $("#userForm").on('submit',function (e) {
                e.preventDefault();
                var userForm = $("#userForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/update-profile/'.$user->id )}}', data);
            })

            $("#changePassword").on('submit',function (e) {
                e.preventDefault();
                var userForm = $("#changePassword");
                var data = new FormData(this);
                $(this).speedPost('{{url('/change-password' )}}', data,userForm);
            })
        })
    </script>
@endsection
