@extends('layouts.app')

@section('title') Payment @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>All Payments</b></h4>
                <p class="text-muted font-13 m-b-30">
                   There is your payment history
                </p>
                <table id="datatable" class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Payable Amount </th>
                        <th>Payment </th>
                        <th>Due </th>
                        <th>Note </th>
                        <th>Payment Taken By </th>
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
                "ajax": "{{ url('/api/outlet/id='.$outlet_id.'/payments') }}",
                "columns": [
                    { "data" : "#"},
                    { "data" : "created_at"},
                    { "data" : "payable_amount" },
                    { "data" : "payment"  },
                    { "data" : "due_amount"  },
                    { "data" : "note"  },
                    { "data" : "user.name"  },
                ],
            });
        })
    </script>

@endsection