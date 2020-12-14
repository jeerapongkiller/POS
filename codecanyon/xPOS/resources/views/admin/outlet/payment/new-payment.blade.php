@extends('layouts.app')

@section('title') Payment  @endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>{{$outlet->outlet_name}} - Payment</b></h4>

                <form class="form-horizontal" method="post" action="{{url('/save-payment')}}" role="form" id="outletForm"
                      enctype="multipart/form-data"
                      data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Current Due*</label>
                        <div class="col-sm-7">
                            <h3 class="form-control-static">
                                <?php
                                $due = 0;
                                foreach (\App\Model\Sell::where('outlet_id',$outlet->id)->where('sell_charges','!=',0)->cursor() as $sell){
                                    $net_value = $sell->sell_value - $sell->discount;
                                    $due += ($net_value * $sell->sell_charges) / 100;
                                }
                                $total_payment = $outlet->outletPayment->sum('payment');
                                ?>
                                {{config('app.currency')}} {{$due - $total_payment}}
                            </h3>
                        </div>
                    </div>
                    <input type="hidden" value="{{$due - $total_payment}}" name="payable_amount">
                    <input type="hidden" value="{{$outlet->id}}" name="outlet_id">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Payment*</label>
                        <div class="col-sm-7">
                            <input type="number" step="0.01" name="payment" required class="form-control" id="inputEmail3"
                                   placeholder="Payment">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Note</label>
                        <div class="col-sm-7">
                            <textarea name="note" id="" cols="30" rows="5" class="form-control"></textarea>
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
    </div>
@endsection