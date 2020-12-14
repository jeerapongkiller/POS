@extends('layouts.app')

@section('title') Product Categories @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Categories</b></h4>
                <p class="text-muted font-13 m-b-30">
                    Product Categories of your outlet. If you are a owner of this outlet then you can edit / delete any of the category from the table bellow. Use
                    <span class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></span> <code>for Edit</code>
                    <span class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></span> <code>for Delete</code>
                </p>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category </th>
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
                "ajax": "{{ url('/api/outlet/id='.$outlet_id.'/categories') }}",
                "columns": [
                    { "data" : "#"},
                    { "data": "category_name" },
                    { "data": "status"  },
                    { "data": "action"  }
                ],
            });
            @if(session('delete_success'))
            $.Notification.notify('success','top right','Product category deleted','Product category has been deleted successfully');
            @endif
        })
    </script>
@endsection

