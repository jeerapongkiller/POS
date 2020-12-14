@extends('layouts.app')

@section('title') Outlet Payments  @endsection


@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-responsive"
                             src="{{url($outlet->logo != '' || $outlet->logo != null ? $outlet->logo : '/images/placeholder.png')}}"
                             alt="">
                    </div>
                    <div class="col-md-8">
                        <h3>{{$outlet->outlet_name}}</h3>
                        <p>{{$outlet->location}} <br> {{$outlet->rent}}</p>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><b>Payment History</b></h4>

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Payable Amount</th>
                            <th>Payment</th>
                            <th>Due</th>
                            <th>Paid to</th>
                            <th>Note</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('extra-js')
    <script src="{{url('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('dashboard/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#datatable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('/api/outlet/id='.$outlet->id.'/payments') }}",
                "columns": [
                    {"data": "#"},
                    {"data": "created_at"},
                    {"data": "payable_amount"},
                    {"data": "payment"},
                    {"data": "due_amount"},
                    {"data": "user.name"},
                    {"data": "note"}
                ],
            });
        })
    </script>
@endsection