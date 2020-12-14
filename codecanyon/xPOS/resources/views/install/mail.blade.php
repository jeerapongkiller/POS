@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action disabled"
               href="#" disabled>Database Setup
            </a>
            <a class="list-group-item list-group-item-action active" href="{{url('/install/mail')}}">Mail Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/admin')}}">Admin Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/localization')}}">Localization</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/tax')}}">Tax Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/finish')}}">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <h4>SMTP mail Setup</h4>
        <form action="{{url('/install/save-mail')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Mail Host</label>
                <input required type="text" name="host" class="form-control"  placeholder="Example smtp.mailtrap.com" value="{{config('mail.host')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mail Port</label>
                <input required type="number" name="port" class="form-control"  placeholder="Ex 25" value="{{config('mail.port')}}">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Email Address</label>
                <input required type="email" name="username" class="form-control" placeholder="Email address" value="{{config('mail.username')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Encryption </label>
                <input type="password" name="encryption" class="form-control" placeholder="Example ssl,ttl" value="{{config('mail.encryption')}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="javascript:void(0)" onclick="$('#skip-mail-setup').submit();">Skip mail setup</a>

        </form>

        <form id="skip-mail-setup" action="{{ url('/install/skip-mail') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <button type="submit"></button>
        </form>
    </div>
@endsection

@section('js')


@endsection
