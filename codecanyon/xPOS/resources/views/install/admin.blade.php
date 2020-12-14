@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action disabled"
               href="#" disabled="">Database Setup
            </a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/mail')}}">Mail Setup</a>
            <a class="list-group-item list-group-item-action active" href="{{url('/install/admin')}}">Admin Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/localization')}}">Localization</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/tax')}}">Tax Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/finish')}}">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <h4>Admin Setup</h4>
        @if(!$user)
        <form id="adminSetup" data-parsley-validate>
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleFormControlFile1">Pro Pic</label>
                <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input required type="text" name="name" class="form-control"  placeholder="Display name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input required type="email" name="email" class="form-control"  placeholder="Admin Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input required type="password" name="password" class="form-control" placeholder="Login password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Re-type Password</label>
                <input required type="password" class="form-control" placeholder="Re type password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @else
            <h5>Admin already added</h5>
        @endif
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#adminSetup").on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url:'{{url('/install/save-admin')}}',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function (data) {
                        console.log(data);
                        window.location.replace('{{url('/install/localization')}}')
                    },error:function (data) {
                        alert('Oops ! someting went wrong');
                        console.log(data)
                    }
                })
            })
        })
    </script>
@endsection