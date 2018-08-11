<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Category\SaveCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    protected $product;
    protected $category;
    protected $image_handler;
    protected $view;
    protected $category_image_dir;
    public function __construct(
        \App\Model\Product $product,
        \App\Model\Category $category,
        \App\Http\BusinessLayer\MediaManager\ImageHandler $image_handler
    )
    {
        $this->product = $product;
        $this->category = $category;
        $this->image_handler = $image_handler;
        $this->view = 'backend/content/category/';
        $this->category_image_dir = getCategoryImagePath();
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
        $image_data = $this->image_handler->saveImage($this->category_image_dir,$request->image);
        $data = array_merge($request->all(), ['image' => $image_data]);
        $this->category->create($data);
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
        $thiscat = $this->category->findOrFail($id);
        $categories = $this->category->where('parent_id', 0)->where('id','!=', $id)->get();
        return view('backend/content/category/edit', compact('thiscat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $image_data = $this->image_handler->updateImage($this->category_image_dir, $request->image, $category->image);
        $data = array_merge($request->all(), ['image' => $image_data]);
        $category->update($data);

        Session::flash('success', 'The category was successfully save!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->products()->detach();
        $this->image_handler->deleteImage(getCategoryImagePath(), $category->image);
        $category->delete();
        Session::flash('success', 'The category was successfully deleted!');
        return redirect()->route('category.index');
    }
}
