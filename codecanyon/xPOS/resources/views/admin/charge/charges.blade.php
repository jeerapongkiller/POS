@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Outlet Sell Charges</b></h4>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Charge for </th>
                        <th>Charge (%)</th>
                        <th>User</th>
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
                "ajax": "{{ url('/api/charges') }}",
                "columns": [
                    { "data" : "#"},
                    { "data": "charge_for" },
                    { "data": "charge"  },
                    { "data": "user.name"  },
                    { "data": "action"  }
                ],
            });

            @if(session('delete_success'))
            $.Notification.notify('success','top right','Charge deleted','Charge has been deleted successfully');
            @endif
        })
    </script>
@endsection