@extends('install.layout')

@section('content')

    <div class="col-md-4">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action disabled"
               href="#" disabled>Database Setup
            </a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/mail')}}">Mail Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/admin')}}">Admin Setup</a>
            <a class="list-group-item list-group-item-action active" href="{{url('/install/localization')}}">Localization</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/tax')}}">Tax Setup</a>
            <a class="list-group-item list-group-item-action" href="{{url('/install/finish')}}">Finish setup</a>
        </div>
    </div>

    <div class="col-md-8">
        <h4>Localization Setup</h4>
        <form id="timezoneSetup" method="post" data-parsley-validate>
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1">Timezone <a target="_blank" href="http://php.net/manual/en/timezones.php">find your timezone</a> </label>
                <input required type="text" name="timezone" class="form-control"  placeholder="Timezone" value="{{config('app.timezone')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Currency</label>
                <input required type="text" name="currency" class="form-control"  placeholder="Currency" value="{{config('app.currency')}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#timezoneSetup").on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url:'{{url('/install/save-local')}}',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function (data) {
                        console.log(data);
                        window.location.replace('{{url('/install/tax')}}')
                    },error:function (data) {
                        alert('Oops ! someting went wrong');
                        console.log(data)
                    }
                })
            })
        })
    </script>
@endsection