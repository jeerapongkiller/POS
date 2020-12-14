@extends('layouts.app')

@section('title')Products @endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('dashboard/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <a href="{{url('/outlet/id='.$outlet_id.'/product/barcode')}}" target="_blank" class="btn btn-success pull-right">Product Barcodes</a>
                <h4 class="m-t-0 header-title"><b>Products</b></h4>
                <p class="text-muted font-13 m-b-30">
                    Products of your outlet. If you are a owner of this outlet then you can edit / delete any of the product from the table bellow. Use
                    <span class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></span> <code>for Edit</code>
                    <span class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></span> <code>for Delete</code>
                </p>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image </th>
                        <th>Product Name</th>
                        <th>Product SKU</th>
                        <th>Price ({{config('app.currency')}})</th>
                        <th>Category</th>
                        @if(auth()->user()->role != 4)
                        <th width="100px">Action</th>
                        @endif
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
                "ajax": "{{ url('/api/outlet/id='.$outlet_id.'/products') }}",
                "columns": [
                    { "data" : "#"},
                    { "data": "image" },
                    { "data": "product_name" },
                    { "data": "product_sku" },
                    { "data": "price"  },
                    { "data": "category.category_name"  },
                    @if(auth()->user()->role != 4)
                    { "data": "action"  }
                    @endif
                ],
            });

            @if(session('delete_success'))
                $.Notification.notify('success','top right','Product deleted','Product has been deleted successfully');
            @endif
        })
    </script>
@endsection