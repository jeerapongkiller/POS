<!--  Modal content for the above example -->
<div id="customerModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Customers Orders</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="holdCustomerOrderInput" placeholder="Search order by customer name" class="form-control">
                <br>
                <div class="row" style="height: 460px; overflow: scroll;" id="randerCustomerOrders">
                    <p>please wait <span class="dot"></span> </p>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
