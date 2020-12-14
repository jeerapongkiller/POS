@extends('layouts.app')

@section('title')
    Edit Outlet
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>New Outlet</b></h4>
                <p class="text-muted font-13 m-b-30">
                    DataTables has most features enabled by default, so all you need to do to use it with
                    your own tables is to call the construction function: <code>$().DataTable();</code>.
                </p>
                <form class="form-horizontal" method="post" action="#" role="form" id="outletForm"
                      enctype="multipart/form-data"
                      data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div id="image-preview" class="col-lg-offset-2"
                         style="background-image: url({{url($outlet->logo != '' || $outlet->logo != null ? $outlet->logo : '')}})">
                        <label for="image-upload" id="image-label">Logo</label>
                        <input type="file" name="logo" id="image-upload"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Outlet Name*</label>
                        <div class="col-sm-7">
                            <input type="text" name="outlet_name" required class="form-control" id="inputEmail3"
                                   placeholder="Outlet Name" value="{{$outlet->outlet_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Outlet Manager*</label>
                        <div class="col-sm-7">
                            <select name="owner" id="" required class="form-control">
                                <option value="">Select owner</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$outlet->owner->id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Outlet Location*</label>
                        <div class="col-sm-7">
                            <textarea required name="location" id="" cols="30" rows="5"
                                      class="form-control">{{$outlet->location}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Monthly Rent*</label>
                        <div class="col-sm-7">
                            <input type="text" name="rent" required class="form-control" id="inputEmail3"
                                   placeholder="Monthly Rent" value="{{$outlet->rent}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Additional Charges</label>
                        <div class="col-sm-7">

                            @forelse($charges as $charge)
                                <div class="checkbox checkbox-primary">

                                    <input name="charge[]" value="{{$charge->id}}" id="checkbox{{$charge->id}}"
                                           type="checkbox"
                                           @foreach($outlet->outletCharges as $nCharge)
                                           @if($nCharge->charge_id == $charge->id)
                                           checked
                                           @endif
                                           @endforeach
                                    >
                                    <label for="checkbox{{$charge->id}}">
                                        {{$charge->charge}}% for {{$charge->charge_for}}
                                    </label>
                                </div>

                            @empty
                                <p class="form-control-static">No charge added <a href="{{url('/new-charge')}}">Click
                                        hear</a> to create outlet charge</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tax Information*</label>
                        <div class="col-sm-7">
                            <p class="form-control-static">TIN : {{$outlet->outletTax->tax_id}} | TAX
                                : {{$outlet->outletTax->tax}} (%)
                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg">Change
                                    tax information</a></p>
                        </div>
                    </div>
                    <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title" id="myLargeModalLabel">TAX Information</h4>
                                    <p>If you change tax information hear it will only effect in this outlet</p>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">TIN number</label>
                                        <div class="col-md-7">
                                            <input type="text" name="tin" value="{{$outlet->outletTax->tax_id}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Tax (%)</label>
                                        <div class="col-md-7">
                                            <input type="number" name="tax" value="{{$outlet->outletTax->tax}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

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
            $("#outletForm").on('submit', function (e) {
                e.preventDefault();
                var outletForm = $("#outletForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/update-outlet/'.$outlet->id)}}', data, outletForm);
            })
        })
    </script>
@endsection