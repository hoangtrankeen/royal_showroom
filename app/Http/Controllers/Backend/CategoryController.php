<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Category\SaveCategoryRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    protected $product;
    protected $category;
    protected $handleCategoryMedia;
    protected $view;
    public function __construct(
        \App\Model\Product $product,
        \App\Model\Category $category,
        \App\Http\BusinessLayer\Category\HandleCategoryMedia $handleCategoryMedia
    )
    {
       $this->product = $product;
       $this->category = $category;
       $this->handleCategoryMedia = $handleCategoryMedia;
       $this->view = 'backend/content/category/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();
        return view( $this->view.'index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *b
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getParentCategories();
        return view($this->view.'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCategoryRequest $request)
    {
        $image_name = $this->handleCategoryMedia->SaveCategoryImages($request->image);

        $category = $this->category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->image = $image_name;
        $category->order = $request->order;
        $category->description = $request->description;
        $category->active = $request->active;
        $category->save();

        Session::flash('success', 'The category was successfully save!');
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['thiscat'] = Category::findOrFail($id);

        $data['categories'] = Category::where('parent_id', 0)->where('id','!=', $id)->get();
        return view('backend/category/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            // rules, criteria
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|max:255|unique:products,slug,'.$id,
            'parent_id'      => 'required|max:255',
            'order'          => 'required|integer',
            'active'          => 'required|integer',
        ));


        $category = Category::findOrFail($id);

        //save image
        if($request->hasFile('image')){
            $photo = $request->file('image');

            if (!is_dir($this->photo_path)) {
                mkdir($this->photo_path, 0777);
            }

            $name = sha1(date('YmdHis') . str_random(30));
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
            $feature_image = $resize_name;
            Image::make($photo)->save($this->photo_path . '/' . $resize_name);

            if($category->image){

                if(\File::exists($this->photo_path.'/'.$category->image)){
                    \File::delete($this->photo_path.'/'.$category->image);
                }
            }
        }else{
            $feature_image = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->image = $feature_image;
        $category->order = $request->order;
        $category->description = $request->description;
        $category->active = $request->active;

        $category->save();

        Session::flash('success', 'The category was successfully save!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->products()->detach();

        $category->delete();

        Session::flash('success', 'The category was successfully deleted!');
        return redirect()->route('category.index');
    }
}
