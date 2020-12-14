@extends('layouts.app')

@section('title')  Sells Men @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Sells Men</b></h4>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo </th>
                        <th>Name </th>
                        <th>Email </th>
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
                "ajax": "{{ url('/api/outlet/id='.$outlet_id.'/sells-man') }}",
                "columns": [
                    { "data" : "#"},
                    { "data": "image" },
                    { "data": "user.name"  },
                    { "data": "user.email"  },
                    { "data": "user_status"  },
                    { "data": "action"  }
                ],
            });

            @if(session('delete_success'))
            $.Notification.notify('success','top right','Sells man deleted','Sells man has been deleted successfully');
            @endif
        })
    </script>
@endsection

