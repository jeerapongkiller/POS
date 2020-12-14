<?php

namespace App\Http\Controllers;

use App\Model\OutletWebsite;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show app setting page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function appSetting()
    {
        return view('admin.setting.setting');
    }

    /**
     * Show web setting page
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function webSetting($outlet_id)
    {
        return view('owner.web-setting',[
            'outlet_id' =>  $outlet_id
        ]);
    }

    /**
     * Post web setting
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postWebSetting(Request $request,$outlet_id)
    {
        $existingWebsite = OutletWebsite::where('outlet_id',$outlet_id)->first();
        if ($existingWebsite){
            $outlet_website = $existingWebsite;
        }else{
            $outlet_website = new OutletWebsite();
        }

        $outlet_website->outlet_id = $outlet_id;
        $outlet_website->title_one  = $request->get('title_one');
        $outlet_website->title_one_size  = $request->get('title_one_size');
        $outlet_website->title_one_color  = $request->get('title_one_color');
        $outlet_website->title_two  = $request->get('title_two');
        $outlet_website->title_two_size  = $request->get('title_two_size');
        $outlet_website->title_two_color  = $request->get('title_two_color');
        $outlet_website->text  = $request->get('text');
        $outlet_website->text_size  = $request->get('text_size');
        $outlet_website->text_color  = $request->get('text_color');
        $outlet_website->card_color  = $request->get('card_color');
        $outlet_website->card_color_hover  = $request->get('card_color_hover');
        $outlet_website->price_color  = $request->get('price_color');
        $outlet_website->price_color_hover  = $request->get('price_color_hover');
        $outlet_website->price_size  = $request->get('price_size');
        $outlet_website->product_title_color  = $request->get('product_title_color');
        $outlet_website->product_title_color_hover  = $request->get('product_title_color_hover');
        $outlet_website->product_title_size  = $request->get('product_title_size');
        $outlet_website->image_height  = $request->get('image_height');
        $outlet_website->image_width  = $request->get('image_width');
        if($request->hasFile('photo')){
            $outlet_website->banner_img = $request->file('photo')
                ->move('uploads/outlet_logo', str_random(40) . '.' . $request->photo->extension());
        }
        if($outlet_website->save()){
            return response()->json(['Website setting saved','Web site settings saved successfully'],200);
        }

    }

}
