<div id="newCustomer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="mySmallModalLabel">New Customer
                    <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="{{url('/images/loading.gif')}}" alt="">
                </h4>
            </div>
            <div class="modal-body">
                <form id="saveCustomer" data-parsley-validate>
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="userName">Customer Name*</label>
                        <input type="text" required="required"  name="name" parsley-trigger="change" placeholder="Enter name" class="form-control" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="userName">Customer Phone*</label>
                        <input type="text" required="required" name="phone" parsley-trigger="change" placeholder="Enter Phone number" class="form-control" id="phoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="userName">Customer Email</label>
                        <input type="email" name="email" parsley-trigger="change" placeholder="Enter email address" class="form-control" id="emilAddress">
                    </div>
                    <div class="form-group">
                        <label for="userName">Customer Address</label>
                        <input type="text" name="address" parsley-trigger="change" placeholder="Enter address" class="form-control" id="userAddress">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block waves-effect waves-light">
                </form>
            </div>
        </div>
    </div>
</div>