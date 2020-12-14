<div class="row">
    <div class="col-md-3">
        <img height="80px" width="80px" src="{{url($outlet->logo != '' || $outlet->logo != null ? $outlet->logo : '/images/placeholder.png')}}" alt="">
    </div>
    <div class="col-md-8">
        <h4>{{$outlet->outlet_name}}</h4>
        <p>{{$outlet->location}} <br></p>
    </div>
</div>