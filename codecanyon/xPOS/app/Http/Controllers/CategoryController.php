<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Show all categories blade view
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($outlet_id)
    {
        return view('owner.product_category.categories', [
            'outlet_id' => $outlet_id
        ]);
    }

    /**
     * Show new category from blade view
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCategory($outlet_id)
    {
        return view('owner.product_category.new', [
            'outlet_id' => $outlet_id
        ]);
    }

    /**
     * Edit category from blade view with category details
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCategory($outlet_id,$id)
    {
        $category = Category::findOrFail($id);
        return view('owner.product_category.edit', [
            'outlet_id' => $outlet_id,
            'category'  =>  $category
        ]);
    }

    /**
     * Save a category by outlet
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveCategory(Request $request, $outlet_id)
    {
        $this->validate($request, [
            'slug' => 'required|unique:categories|max:191',
        ]);

        $category = new Category();
        $category->outlet_id = $outlet_id;
        $category->category_name = $request->get('category_name');
        $category->slug = $request->get('slug');
        $category->status = 1;
        $category->user_id = auth()->user()->id;
        if ($category->save()) {
            return response()->json(['Product category saved', 'Product category has been saved successfully'], 200);
        }
    }

    /**
     * Update a category by outlet id and category id
     *
     * @param Request $request
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCategory(Request $request,$outlet_id,$id)
    {
        $this->validate($request, [
            'slug' => 'required',Rule::unique('categories')->ignore('id',$id)
        ]);

        $category = Category::findOrFail($id);
        $category->outlet_id = $outlet_id;
        $category->category_name = $request->get('category_name');
        $category->slug = $request->get('slug');
        $category->status = $request->get('status') == 'on' ? 1 : 0;
        $category->user_id = auth()->user()->id;
        if ($category->save()) {
            return response()->json(['Product category updated', 'Product category has been updated successfully'], 200);
        }
    }

    /**
     * Delete a category
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory($outlet_id,$id){
        $category = Category::where('outlet_id',$outlet_id)->where('id',$id)->firstOrFail();
        if($category->delete()){
            return redirect()->back()->with('delete_success','Delete Success');
        }
    }
}
