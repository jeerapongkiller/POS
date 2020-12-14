@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action active"
               href="{{url('/install/database')}}">Database Setup
            </a>
            <a class="list-group-item list-group-item-action" href="#">Mail Setup</a>
            <a class="list-group-item list-group-item-action" href="#">Admin Setup</a>
            <a class="list-group-item list-group-item-action" href="#">Localization</a>
            <a class="list-group-item list-group-item-action" href="#">Tax Setup</a>
            <a class="list-group-item list-group-item-action" href="#">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <h4>Database Setup <small>{{config('install.database')}}</small></h4>
        <form method="post" action="javascript:void(0)" id="databseForm" data-parsley-validate>
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1">Host</label>
                <input required name="db_host" type="text" class="form-control"  placeholder="Default 127.0.0.1" value="{{config('database.connections.mysql.host')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Port</label>
                <input required name="db_port" type="text" class="form-control"  placeholder="Default 3306" value="{{config('database.connections.mysql.port')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Database Name</label>
                <input required name="db_database_name" type="text" class="form-control"  placeholder="Database name" value="{{config('database.connections.mysql.database')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Username</label>
                <input required name="db_username" type="text" class="form-control" placeholder="MySQL user name" value="{{config('database.connections.mysql.username')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input required name="db_password" type="password" id="password" class="form-control" placeholder="MySQL password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Re-type Password</label>
                <input required data-parsley-equalto="#password" type="password" class="form-control" placeholder="MySQL password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <img src="{{url('/images/loading-2.gif')}}" height="120px" id="loading" alt="">
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#loading').hide();
            $('#databseForm').on('submit',function (e) {
                e.preventDefault();
                $('#loading').show();
                var formData = new FormData(this);
                $.ajax({
                    url:'{{url('/install/save-database')}}',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function (data) {
                        window.location.replace('{{url('/install/mail')}}')
                    },error:function (data) {
                        $('#loading').hide();
                        alert('Oops ! look like your given details is not correct. \nSystem cannot create table in selected database');
                    }
                })
            })
        })
    </script>
@endsection