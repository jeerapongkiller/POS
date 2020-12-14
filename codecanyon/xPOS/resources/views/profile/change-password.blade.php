<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-horizontal" id="changePassword" data-parsley-validate>
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-4 control-label">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password"  placeholder="Current Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-4 control-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="new_password" id="password"  placeholder="New Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hori-pass2" class="col-sm-4 control-label">Re-Type Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="confirm" data-parsley-equalto="#password" placeholder="Re-type new password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
