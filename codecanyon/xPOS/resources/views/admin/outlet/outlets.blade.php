@extends('layouts.app')

@section('title') Outlets  @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Outlets</b></h4>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Outlet Details</th>
                        <th>Owner Details</th>
                        <th>Other Charges</th>
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
                "ajax": "{{ url('/api/outlets') }}",
                "columns": [
                    {"data": "#"},
                    {"data": "outlet_details"},
                    {"data": "owner_details"},
                    {"data": "charges"},
                    {"data": "action"}
                ],
            });

            @if(session('delete_success'))
            $.Notification.notify('success','top right','Outlet deleted','Outlet has been deleted successfully');
            @endif
        })
    </script>
@endsection