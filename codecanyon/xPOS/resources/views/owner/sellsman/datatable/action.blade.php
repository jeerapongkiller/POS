<div class="btn-group">
    <a href="{{url('/outlet/id='.$user_outlet->outlet_id.'/edit-sells-man/'.$user_outlet->user_id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
    <button onclick="$(this).confirmDelete('{{url('/outlet/id='.$user_outlet->outlet_id.'/delete-sells-man/'.$user_outlet->user_id)}}')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>