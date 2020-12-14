@extends('layouts.app')

@section('title') New Category @endsection

@section('content')

    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Product Category</b></h4>
            <p class="text-muted font-13 m-b-30">
                This charge will not be shown in customer receipt.
            </p>

            <form class="form-horizontal" role="form" id="categoryForm" enctype="multipart/form-data" data-parsley-validate
                  novalidate>
                {{csrf_field()}}

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Category Name*</label>
                    <div class="col-sm-7">
                        <input type="text" name="category_name" required class="form-control" id="catName"
                               placeholder="Product category name">
                    </div>
                </div>
                <input type="hidden" id="slug" name="slug">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Save
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {
            $("#catName").on('input',function () {
                var catName = $('#catName').val();
                $("#slug").val(catName.split(' ').join('-').toLowerCase()+"-"+'{{$outlet_id}}');
            })

            $("#categoryForm").on('submit',function (e) {
                e.preventDefault();
                var categoryForm = $("#categoryForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/outlet/id='.$outlet_id.'/save-category')}}',data,categoryForm);
            })
        })
    </script>
@endsection