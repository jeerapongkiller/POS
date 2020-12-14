<style>
    .order-box{
        background-color: grey;
        color: #FFFFFF;
    }
</style>

<!--  Modal content for the above example -->
<div id="holdOrdersModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Hold Orders</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="holdOrderInput" placeholder="Search order by ref number" class="form-control">
                <br>
                <div class="row" style="height: 460px;overflow-x: hidden;overflow-y:scroll" id="randerHoldOrders">
                    <p>please wait <span class="dot"></span> </p>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
