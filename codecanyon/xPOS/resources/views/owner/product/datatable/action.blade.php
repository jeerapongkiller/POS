
<div class="btn-group">
    <a href="{{url('/outlet/id='.$product->outlet_id.'/edit-product/'.$product->id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
    <button onclick="$(this).confirmDelete('{{url('/outlet/id='.$product->outlet_id.'/delete-product/'.$product->id)}}')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>