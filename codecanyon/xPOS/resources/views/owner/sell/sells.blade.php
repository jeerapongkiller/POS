@extends('layouts.app')

@section('title') All Sell @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>All Sell</b></h4>

                <table id="datatable" class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Ref </th>
                        <th>Customer </th>
                        <th>Sell By </th>
                        <th>Price ({{config('app.currency')}})</th>
                        <th>Tax (%)</th>
                        <th>Price with Vat {{config('app.currency')}}</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
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
                "ajax": "{{ url('/api/outlet/id='.$outlet_id.'/sells') }}",
                "columns": [
                    { "data" : "#"},
                    { "data" : "created_at"},
                    { "data": "ref_number" },
                    { "data": "customer"  },
                    { "data": "sellsman"  },
                    { "data": "price"  },
                    { "data": "vat"  },
                    { "data": "gross_price"  },
                    { "data": "status"  },
                    { "data": "action"  }
                ],
            });
        })
    </script>

@endsection