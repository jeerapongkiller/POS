@extends('layouts.app')

@section('extra-css')

    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('/dashboard/plugins/clockpicker/css/bootstrap-clockpicker.min.css')}}">
    <link rel="stylesheet" href="{{url('/dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">

    <style>
        #image-preview{
            background-color: dimgray;
            width: 720px;
            margin-bottom: 15px;
        }
    </style>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4>Web site setting</h4>

                <?php
                    $website_setting = \App\Model\OutletWebsite::where('outlet_id',$outlet_id)->first();

                ?>
                @if($website_setting)
                    <form class="form-horizontal" role="form" id="webSetting" enctype="multipart/form-data" data-parsley-validate
                          novalidate>
                        {{csrf_field()}}
                        <div id="image-preview" class="col-lg-offset-2" style="background-image: url('{{url($website_setting->banner_img != '' || $website_setting->banner_img != null ? $website_setting->banner_img : '/images/placeholder.png')}}')">
                            <label for="image-upload" id="image-label">banner image 1500x350</label>
                            <input type="file" name="photo" id="image-upload"/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title One*</label>
                            <div class="col-sm-7">
                                <input type="text" name="title_one" required value="{{$website_setting->title_one}}" class="form-control" placeholder="Banner Title One">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title One Size*</label>
                            <div class="col-sm-7">
                                <input type="number" max="72" name="title_one_size" value="{{$website_setting->title_one_size}}" required class="form-control" placeholder="Title Two Font Size">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title One Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="title_one_color" required value="{{$website_setting->title_one_color}}" class="form-control"  placeholder="Title One Font Color">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title Two*</label>
                            <div class="col-sm-7">
                                <input type="text" name="title_two" required value="{{$website_setting->title_two}}" class="form-control" placeholder="Banner Title Two">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title Two Size*</label>
                            <div class="col-sm-7">
                                <input type="number" name="title_two_size" required value="{{$website_setting->title_two_size}}" class="form-control" placeholder="Title Two Font Size">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title Two Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="title_two_color" required value="{{$website_setting->title_two_color}}" class="form-control" placeholder="Title Two Font Color">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Banner text*</label>
                            <div class="col-sm-7">
                                <textarea name="text" id="" required  cols="30" rows="5" class="form-control" placeholder="Banner Text">{{$website_setting->text}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Banner Text Size*</label>
                            <div class="col-sm-7">
                                <input type="number" name="text_size" required value="{{$website_setting->text_size}}" class="form-control" placeholder="Banner text font size">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Banner Text Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="text_color" required value="{{$website_setting->text_color}}" class="form-control" placeholder="Banner Text font color">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Card Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="card_color" required value="{{$website_setting->card_color}}" class="form-control" placeholder="Product card background color">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Card Color on Hover*</label>
                            <div class="col-sm-7">
                                <input type="color" name="card_color_hover" required value="{{$website_setting->card_color_hover}}" class="form-control" placeholder="Product card background color on mouse hover">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Price Size*</label>
                            <div class="col-sm-7">
                                <input type="number" max="72" name="price_size" required value="{{$website_setting->price_size}}" class="form-control" placeholder="Product price font size">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Price Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="price_color" required value="{{$website_setting->price_color}}" class="form-control" placeholder="Product price font color">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Price Color on Hover*</label>
                            <div class="col-sm-7">
                                <input type="color" name="price_color_hover" required value="{{$website_setting->price_color_hover}}" class="form-control" placeholder="Product price font color on mouse hover">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Title Size*</label>
                            <div class="col-sm-7">
                                <input type="number" max="72" name="product_title_size" required  value="{{$website_setting->product_title_size}}" class="form-control" placeholder="Product tile font size">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Title Color*</label>
                            <div class="col-sm-7">
                                <input type="color" name="product_title_color" required value="{{$website_setting->product_title_color}}" class="form-control" placeholder="Product title font color">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Title Color on Hover*</label>
                            <div class="col-sm-7">
                                <input type="color" name="product_title_color_hover" required value="{{$website_setting->product_title_color_hover}}" class="form-control" placeholder="Product title font on hover">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Image Height*</label>
                            <div class="col-sm-7">
                                <input type="number" max="300" name="image_height" required value="{{$website_setting->image_height}}" class="form-control" placeholder="Product image height">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Product Image Width*</label>
                            <div class="col-sm-7">
                                <input type="number" max="300" name="image_width" required value="{{$website_setting->image_width}}" class="form-control" placeholder="Product image width">
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
                @else
                <form class="form-horizontal" role="form" id="webSetting" enctype="multipart/form-data" data-parsley-validate
                      novalidate>
                    {{csrf_field()}}
                    <div id="image-preview" class="col-lg-offset-2">
                        <label for="image-upload" id="image-label">banner image 1500x350</label>
                        <input type="file" name="photo" required id="image-upload"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title One*</label>
                        <div class="col-sm-7">
                            <input type="text" name="title_one" required class="form-control" placeholder="Banner Title One">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title One Size*</label>
                        <div class="col-sm-7">
                            <input type="number" max="72" name="title_one_size" required class="form-control" placeholder="Title Two Font Size">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title One Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="title_one_color" required class="form-control"  placeholder="Title One Font Color">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title Two*</label>
                        <div class="col-sm-7">
                            <input type="text" name="title_two" required class="form-control" placeholder="Banner Title Two">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title Two Size*</label>
                        <div class="col-sm-7">
                            <input type="number" name="title_two_size" required class="form-control" placeholder="Title Two Font Size">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title Two Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="title_two_color" required class="form-control" placeholder="Title Two Font Color">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Banner text*</label>
                        <div class="col-sm-7">
                            <textarea name="text" id="" required cols="30" rows="5" class="form-control" placeholder="Banner Text"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Banner Text Size*</label>
                        <div class="col-sm-7">
                            <input type="number" name="text_size" required class="form-control" placeholder="Banner text font size">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Banner Text Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="text_color" required class="form-control" placeholder="Banner Text font color">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Card Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="card_color" required class="form-control" placeholder="Product card background color">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Card Color on Hover*</label>
                        <div class="col-sm-7">
                            <input type="color" name="card_color_hover" required class="form-control" placeholder="Product card background color on mouse hover">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Price Size*</label>
                        <div class="col-sm-7">
                            <input type="number" max="72" name="price_size" required class="form-control" placeholder="Product price font size">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Price Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="price_color" required class="form-control" placeholder="Product price font color">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Price Color on Hover*</label>
                        <div class="col-sm-7">
                            <input type="color" name="price_color_hover" required class="form-control" placeholder="Product price font color on mouse hover">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Title Size*</label>
                        <div class="col-sm-7">
                            <input type="number" max="72" name="product_title_size" required class="form-control" placeholder="Product tile font size">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Title Color*</label>
                        <div class="col-sm-7">
                            <input type="color" name="product_title_color" required class="form-control" placeholder="Product title font color">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Title Color on Hover*</label>
                        <div class="col-sm-7">
                            <input type="color" name="product_title_color_hover" required class="form-control" placeholder="Product title font on hover">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Image Height*</label>
                        <div class="col-sm-7">
                            <input type="number" max="300" name="image_height" required class="form-control" placeholder="Product image height">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Product Image Width*</label>
                        <div class="col-sm-7">
                            <input type="number" max="300" name="image_width" required class="form-control" placeholder="Product image width">
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
                @endif
            </div>
        </div>
    </div>

@endsection

@section('extra-js')
    <script src="{{url('/dashboard/plugins/moment/moment.js')}}"></script>
    <script src="{{url('/dashboard/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{url('/dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{url('/dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('/dashboard/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>

    <script src="{{url('/dashboard/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('/dashboard/pages/jquery.form-pickers.init.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#webSetting").on('submit',function (e) {
                e.preventDefault();
                var userForm = $("#webSetting");
                var data = new FormData(this);
                $(this).speedPost('{{url('/outlet/id='.$outlet_id.'/save-web-site-setting')}}', data);
            })
        })
    </script>
@endsection