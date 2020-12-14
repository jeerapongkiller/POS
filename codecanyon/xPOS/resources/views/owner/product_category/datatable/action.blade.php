<div class="btn-group">
    <a href="{{url('/outlet/id='.$cat->outlet_id.'/edit-category/'.$cat->id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
    <button onclick="$(this).confirmDelete('{{url('/outlet/id='.$cat->outlet_id.'/delete-category/'.$cat->id)}}')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>