@forelse($outlet->outletCharges as $charge)
    <p>{{$charge->outletCharge->charge_for}} {{$charge->charge}} %</p>
@empty
    <p>No extra charge</p>
@endforelse
