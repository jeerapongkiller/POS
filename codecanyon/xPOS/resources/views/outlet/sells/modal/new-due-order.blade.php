<div id="dueModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="mySmallModalLabel">Hold Order
                    <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="{{url('/images/loading.gif')}}" alt="">
                </h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <input type="text" id="refNumber" placeholder="Enter ref number" class="form-control">
                </form>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="$(this).go(1,true);" class="btn btn-success btn-lg btn-block">1</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(2,true);" class="btn btn-success btn-lg btn-block">2</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(3,true);" class="btn btn-success btn-lg btn-block">3</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="$(this).go(4,true);" class="btn btn-success btn-lg btn-block">4</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(5,true);" class="btn btn-success btn-lg btn-block">5</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(6,true);" class="btn btn-success btn-lg btn-block">6</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="$(this).go(7,true);" class="btn btn-success btn-lg btn-block">7</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(8,true);" class="btn btn-success btn-lg btn-block">8</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(9,true);" class="btn btn-success btn-lg btn-block">9</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="$('#refNumber').val($('#refNumber').val().substr(0,$('#refNumber').val().length -1))" class="btn btn-success btn-lg btn-block">⌫</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$(this).go(0,true);" class="btn btn-success btn-lg btn-block">0</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="$('#refNumber').val('')" class="btn btn-success btn-lg btn-block">AC</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="$(this).submitDueOrder(0);" class="btn btn-primary btn-block btn-lg waves-effect waves-light">Hold Order</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
