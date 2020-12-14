@extends('layouts.app')

@section('title') Employees @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Users</b></h4>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
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
                "ajax": "{{ url('/api/users') }}",
                "columns": [
                    { "data" : "#"},
                    { "data": "image" },
                    { "data": "name"  },
                    { "data": "email"  },
                    { "data": "phone"  },
                    { "data": "role"  },
                    { "data": "action"  }
                ],
            });

            @if(session('delete_success'))
            $.Notification.notify('success','top right','User deleted','user has been deleted successfully');
            @endif
        })
    </script>
@endsection