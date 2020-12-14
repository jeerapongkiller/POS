@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action disabled"
               href="#" disabled>Database Setup
            </a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/mail')}}">Mail Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/admin')}}">Admin Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/localization')}}">Localization</a>
            <a class="list-group-item list-group-item-action active" href="{{url('/install/tax')}}">Tax Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/finish')}}">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <h4>Tax Setup</h4>
        <form id="taxSetup" action="{{url('/install/save-tax')}}" method="post" data-parsley-validate>
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1">TIN number (Tax identification number ) </label>
                <input required type="text" name="tin" class="form-control" value="{{config('app.tin')}}" placeholder="Tax identification number">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">TAX (%)</label>
                <input required type="number" name="tax" class="form-control" value="{{config('app.tax')}}"  placeholder="Tax">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
