@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action "
               href="{{url('/install/database')}}">Database Setup
            </a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/mail')}}">Mail Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/admin')}}">Admin Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/localization')}}">Localization</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/tax')}}">Tax Setup</a>
            <a class="list-group-item list-group-item-action active" href="{{url('/install/finish')}}">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <ul>
            <li>Database setup ----- {{config('install.database') == 1 ? 'Ok' : 'Not ok'}} </li>
            <li>Admin setup -------- {{count($user) != 0 ? 'Ok' : 'Not ok'}}</li>
            <li>Mail setup ----------- Ok</li>
            <li>Localization setup--- Ok</li>
            <li>Tax setup ------------ Ok</li>
        </ul>
        <center>
            <br>
            <br>
            <br>
            @if(count($user) != 0)
            <form action="{{url('/install/to-login')}}" method="post">
                {{csrf_field()}}
                <button type="submit" class="btn btn-success btn-block">Login</button>
            </form>
            @else
                <p>You mighg not set an admin account. please create an admin to continue</p>
            @endif
        </center><br>
    </div>

@endsection