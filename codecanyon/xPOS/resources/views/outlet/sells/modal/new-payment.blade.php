<!--  Modal content for the above example -->
<div id="paymentModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Payment</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="javascript:void(0)" id="cash" onclick="paymentType = 1" class="list-group-item active">
                                Cash
                            </a>
                            <a href="javascript:void(0)" id="check" onclick="paymentType = 2" class="list-group-item">Check</a>
                            <a href="javascript:void(0)" id="card" onclick="paymentType = 3" class="list-group-item">Card</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">Price $ </span>
                            <input id="payablePrice" readonly type="number"  class="form-control" aria-describedby="basic-addon3">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">Payment  $ </span>
                            <input type="text" placeholder="0.0" class="form-control" id="payment" aria-describedby="basic-addon3">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(1,false);" class="btn btn-success btn-lg btn-block">1</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(2,false);" class="btn btn-success btn-lg btn-block">2</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(3,false);" class="btn btn-success btn-lg btn-block">3</button>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(4,false);" class="btn btn-success btn-lg btn-block">4</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(5,false);" class="btn btn-success btn-lg btn-block">5</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(6,false);" class="btn btn-success btn-lg btn-block">6</button>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(7,false);" class="btn btn-success btn-lg btn-block">7</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(8,false);" class="btn btn-success btn-lg btn-block">8</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(9,false);" class="btn btn-success btn-lg btn-block">9</button>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button onclick="$('#payment').val($('#payment').val().substr(0,$('#payment').val().length -1));$(this).calculateChange();" class="btn btn-success btn-lg btn-block">⌫</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).go(0,false);" class="btn btn-success btn-lg btn-block">0</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="$(this).digits()" class="btn btn-success btn-lg btn-block">.</button>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button onclick="$('#payment').val('');$(this).calculateChange();" class="btn btn-danger btn-block btn-lg">AC</button>
                            </div>
                        </div>
                        <br>
                        <div class="input-group" id="cardInfo">
                            <span class="input-group-addon" id="basic-addon3">Check Info / Card Info </span>
                            <input type="text" class="form-control" id="paymentInfo" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div  class="btn btn-primary btn-block btn-lg waves-effect waves-light">Change {{config('app.currency')}}<span id="change"></span> </div>
                <button type="button" id="confirmPayment" class="btn btn-primary btn-block btn-lg waves-effect waves-light">Confirm Payment</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

