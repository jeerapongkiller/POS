<div class="btn-group">
    <a href="{{url('/edit-outlet/'.$id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
    <button onclick="$(this).confirmDelete('{{url('/delete-outlet/'.$id)}}')" type="button" class="btn btn-danger"><i
                class="fa fa-trash"></i></button>
</div>
<br>
<br>
<a href="{{url('/outlet/id='.$id.'/dashboard')}}" class="btn btn-success">Browse Outlet</a>


