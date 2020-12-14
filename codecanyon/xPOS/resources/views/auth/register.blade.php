@extends('layouts.app')

@section('content')
<center>
    <h1>You cannot register after creating an admin</h1>
    <a href="{{url('/login')}}" class="btn btn-success">Click to login</a><br>
</center>
@endsection
