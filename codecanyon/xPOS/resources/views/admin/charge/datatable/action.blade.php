<div class="btn-group">
    <a href="{{url('/edit-charge/'.$id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
    <button onclick="$(this).confirmDelete('{{url('/delete-charge/'.$id)}}')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>