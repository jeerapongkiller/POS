<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Show products by outlet id
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($outlet_id)
    {
        return view('owner.product.products',[
            'outlet_id'     =>  $outlet_id
        ]);
    }

    /**
     * Show new product form
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newProduct($outlet_id)
    {
        $categories = Category::where('outlet_id',$outlet_id)->get();
        return view('owner.product.new-product',[
            'outlet_id'     =>  $outlet_id,
            'categories'    =>  $categories
        ]);
    }

    /**
     * Show edit product form
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct($outlet_id,$id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('outlet_id',$outlet_id)->get();
        return view('owner.product.edit-product',[
            'outlet_id'     =>  $outlet_id,
            'categories'    =>  $categories,
            'product'       =>  $product
        ]);
    }

    /**
     * Save a product by outlet
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProduct(Request $request,$outlet_id)
    {
        $this->validate($request,[
            'product_name'  =>  'required|max:100',
            'product_sku'   =>  'required|max:100|unique:products',
            'price'         =>  'required|numeric',
            'category_id'   =>  'required|max:100|numeric'
        ]);

        $product = new Product();
        $product->outlet_id = $outlet_id;
        $product->product_name = $request->get('product_name');
        $product->product_sku = $request->get('product_sku');
        $product->price = $request->get('price');
        $product->category_id = $request->get('category_id');
        $product->user_id = auth()->user()->id;
        if($request->hasFile('image')){
            $product->image =  $request->file('image')
                ->move('uploads/product_image', str_random(40) . '.' . $request->image->extension());
        }
        if($product->save()){
            return response()->json(['Product saved','Product has been saved successfully'],200);
        }
    }

    /**
     * Update product by outlet
     *
     * @param Request $request
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProduct(Request $request,$outlet_id,$id)
    {
        $this->validate($request,[
            'product_name'  =>  'required|max:100',
            'product_sku'   =>  'required|max:100,',Rule::unique('products')->ignore('id',$id),
            'price'         =>  'required|numeric',
            'category_id'   =>  'required|max:100|numeric'
        ]);

        $product = Product::findOrFail($id);
        $product->outlet_id = $outlet_id;
        $product->product_name = $request->get('product_name');
        $product->product_sku = $request->get('product_sku');
        $product->price = $request->get('price');
        $product->category_id = $request->get('category_id');
        $product->user_id = auth()->user()->id;
        if($request->hasFile('image')){
            $product->image =  $request->file('image')
                ->move('uploads/product_image', str_random(40) . '.' . $request->image->extension());
        }
        if($product->save()){
            return response()->json(['Product updated','Product has been updated successfully'],200);
        }


    }

    /**
     * Generate product bar code
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function barcode($outlet_id)
    {
        $products = Product::where('outlet_id',$outlet_id)->get();
        return view('owner.product.barcode',[
            'outlet_id' =>  $outlet_id,
            'products'  =>  $products
        ]);
    }

    /**
     * Delete product
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($outlet_id,$id)
    {
        if(Product::destroy($id)){
            return redirect()->back()->with('delete_success','Product has been deleted successfully');
        }
    }
}
