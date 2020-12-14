<div class="row">
    <div class="col-md-3">
        <img width="80px" height="80px" src="{{$outlet->owner->image != '' || $outlet->owner->image != null ? $outlet->owner->image : '/images/placeholder.png'}}" alt="">
    </div>
    <div class="col-md-8">
        <h4>{{$outlet->owner->name}}</h4>
        <p>{{$outlet->owner->phone}} <br> {{$outlet->owner->email}}</p>
    </div>
</div>