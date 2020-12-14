@extends('layouts.app')

@section('title')Edit Product @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Edit Product</b></h4>
                <p class="text-muted font-13 m-b-30">

                </p>
                <form class="form-horizontal" method="post" action="#" role="form" id="productForm"
                      enctype="multipart/form-data"
                      data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div id="image-preview"
                         style="background-image: url('{{url($product->image != ' ' || $product->image != null ? $product->image : '/images/placeholder.png')}}')"
                         class="col-lg-offset-2">
                        <label for="image-upload" id="image-label">Image</label>
                        <input type="file" name="image" id="image-upload"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Name*</label>
                        <div class="col-sm-7">
                            <input type="text" value="{{$product->product_name}}" name="product_name" required
                                   class="form-control" id="inputProductName"
                                   placeholder="Product Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product SKU*</label>
                        <div class="col-sm-7">
                            <input type="text" value="{{$product->product_sku}}" name="product_sku" required
                                   class="form-control" id="inputProductSKU"
                                   placeholder="Product SKU">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Price*</label>
                        <div class="col-sm-7">
                            <input type="number" value="{{$product->price}}" step="0.01" name="price" required
                                   class="form-control" id="inputPrice"
                                   placeholder="Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Category*</label>
                        <div class="col-sm-7">
                            <select name="category_id" id="" required class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


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
    </div>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {
            /**
             * Make product name to product slug
             */
            $("#inputProductName").on('input', function (e) {
                e.preventDefault();
                var productName = $(this).val();
                $("#inputProductSKU").val(productName.split(' ').join('_').toLowerCase());
            });

            /**
             * Save product by ajax request
             */
            $("#productForm").on('submit', function (e) {
                e.preventDefault();
                var productForm = $("#productForm");
                var data = new FormData(this);
                $(this).speedPost('{{url('/outlet/id='.$outlet_id.'/update-product/'.$product->id)}}', data);
            });
        });
    </script>
@endsection