@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Edit Charge</b></h4>
            <p class="text-muted font-13 m-b-30">
                This charge will not be shown in customer receipt.
            </p>

            <form class="form-horizontal" role="form" id="chargeForm" enctype="multipart/form-data" data-parsley-validate
                  novalidate>
                {{csrf_field()}}

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Charge for*</label>
                    <div class="col-sm-7">
                        <input type="text" name="charge_for" required class="form-control" id="inputEmail3"
                               placeholder="Charge for">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Charge (%)*</label>
                    <div class="col-sm-7">
                        <input  data-parsley-min="0.1" type="number" step="0.1" name="charge" required class="form-control" id="inputEmail3"
                                placeholder="Charge (%)">
                        <p>This charge will be applied on every sell by outlet</p>
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
@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {
            $("#chargeForm").on('submit',function (e) {
                e.preventDefault();
                var userForm = $("#chargeForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/save-charge')}}',data,userForm)
            })
        });
    </script>
@endsection