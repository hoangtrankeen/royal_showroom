<?php

namespace App\Http\Controllers\Backend;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class ProductGroupController extends ProductController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $this->validate($request, array(
            // rules, criteria
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:products,slug',
            'sku'            => 'required|min:5|max:255|unique:products,sku',
            'categories'     => 'required',
            'price'          => 'required|integer',
            'quantity'       => 'required|integer',
            'description'    => 'required|max:255',
            'details'        => 'required|max:255',
            'images.*'       => 'sometimes|required|image',
            'image'         => 'sometimes|required|image',
            'sort_order'     => 'required|integer',
            'type_id'        => 'required',
            'child_product'  => 'required'
        ));

        //Store Image
        $image_name = [];

        if($request->hasFile('images')){
            $photos = $request->file('images');

            if (!is_array($photos)) {
                $photos = [$photos];
            }

            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }

            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(30));
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
                $image_name[] =$resize_name;

                Image::make($photo)->save($this->photos_path . '/' . $resize_name);

            }

            $image_name = json_encode($image_name);
        }else{
            $image_name = null;
        }


        $feature_image = '';

        if($request->hasFile('image')){
            $photo = $request->file('image');

            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }

            $name = sha1(date('YmdHis') . str_random(30));
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
            $feature_image = $resize_name;

            Image::make($photo)
                ->save($this->photos_path . '/' . $resize_name);
        }else{
            $feature_image = null;
        }

        $child_array = [];


        foreach (explode(',',$request->child_product) as $child) {
            $child_array[] = (int) $child;
        }

        //Store Product Parent
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->slug = $request->slug;

        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->details = $request->details;
        $product->description = $request->description;

        $product->featured = $request->featured;
        $product->visibility = $request->visibility;
        $product->active = $request->active;
        $product->in_stock = $request->in_stock;

        $product->image = $feature_image;
        $product->images = $image_name;

        $product->sort_order = $request->sort_order;

        $product->type_id = $request->type_id;

        $product->child_id = json_encode($child_array);

        $product->save();

        //Store Product - Category
        $product->categories()->sync($request->categories);

        // Store Parent Id
        $childArr =  json_decode($product->child_id);

        $childProduct = Product::whereIn('id', $childArr)->get();

        foreach($childProduct as $child) {

            $parent_id = json_decode($child->parent_id);

            if($parent_id){
                if(!in_array($product->id, $parent_id )){
                    $parent_id[] = $product->id;
                }
            }else{
                $parent_id = [];
                $parent_id[] = $product->id;
            }


            $child_product = Product::find($child->id);

            $child_product->parent_id = json_encode($parent_id);

            $child_product->save();
        }

        Session::flash('success', 'The product was successfully save!');
        return redirect()->route('product-group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = $product->categories;

        $cat_ids = [];

        foreach ($categories as $category)
        {
            $cat_ids[] = $category->id;
        }

        $data['product'] = $product;

        $data['all_products'] = Product::getSimpleProduct();

        $data['cat_ids'] = $cat_ids;

        $data['categories'] = Category::all();

        return view('backend/product/edit-group', $data);
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
        //Validate
        $this->validate($request, array(
            // rules, criteria
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:products,slug,'.$id,
            'sku'            => 'required|min:5|max:255|unique:products,sku,'.$id,
            'categories'     => 'required',
            'price'          => 'required|integer',
            'quantity'       => 'required|integer',
            'description'    => 'required|max:255',
            'details'        => 'required|max:255',
            'images.*'       => 'sometimes|required|image',
            'image'       => 'sometimes|required|image',
            'sort_order'     => 'required|integer',
            'type_id'        => 'required',
            'child_product'       => 'required'
        ));
        
        $product = Product::find($id);

        //Store Image
        $image_name = [];

        if($request->hasFile('images')){
            $photos = $request->file('images');

            if (!is_array($photos)) {
                $photos = [$photos];
            }

            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }

            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(30));
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
                $image_name[] =$resize_name;

                Image::make($photo)
                    ->save($this->photos_path . '/' . $resize_name);
            }
            $image_name = json_encode($image_name);

            if($product->images){
                foreach (json_decode($product->images) as $image){

                    if(\File::exists($this->photos_path.'/'.$image)){
                        \File::delete($this->photos_path.'/'.$image);
                    }
                }
            }

        }else{
            $image_name = $product->images;
        }

        //Save feature image
        $feature_image = '';

        if($request->hasFile('image')){
            $photo = $request->file('image');

            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }

            $name = sha1(date('YmdHis') . str_random(30));
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
            $feature_image = $resize_name;

            Image::make($photo)
                ->save($this->photos_path . '/' . $resize_name);
            if(\File::exists($this->photos_path.'/'.$product->image)){
                \File::delete($this->photos_path.'/'.$product->image);
            }
        }else{
            $feature_image = $product->image;
        }

        $child_array = [];

        foreach (json_decode($request->child_product) as $child) {
            $child_array[] = (int) $child;
        }

        //Store Product Parent
        $product = Product::find($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->slug = $request->slug;

        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->details = $request->details;
        $product->description = $request->description;

        $product->featured = $request->featured;
        $product->visibility = $request->visibility;
        $product->active = $request->active;
        $product->in_stock = $request->in_stock;

        $product->images = $image_name;
        $product->image = $feature_image;

        $product->sort_order = $request->sort_order;

        $product->type_id = $request->type_id;

        $product->child_id = json_encode($child_array);

        $product->save();

        //Store Product - Category
        $product->categories()->sync($request->categories);

        // Store Parent Id
        $childArr =  json_decode($product->child_id);

        $childProduct = Product::whereIn('id', $childArr)->get();

        foreach($childProduct as $child) {

            $parent_id = json_decode($child->parent_id);

            if($parent_id){
                if(!in_array($product->id, $parent_id )){
                    $parent_id[] = $product->id;
                }
            }else{
                $parent_id = [];
                $parent_id[] = $product->id;
            }

            $child_product = Product::find($child->id);

            $child_product->parent_id = json_encode($parent_id);

            $child_product->save();
        }

        Session::flash('success', 'The product was successfully updated!');
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
        $product = Product::findOrFail($id);


        $product->categories()->detach();
        $product->attributeValue()->detach();
        $product->orders()->detach();

        $simples = Product::where('type_id','simple')->get();

        foreach($simples as $simple)
        {
            $parent_id = json_decode($simple->parent_id);

            if(is_array($parent_id) ){
                $key = array_search($id,$parent_id);

                if($key!==false){

                    unset($parent_id[$key]);

                    $update = Product::find($simple->id);

                    $update->parent_id = json_encode($parent_id);
                    $update->save();
                }
            }
        }

        $product->delete();

        Session::flash('success', 'The product was successfully deleted!');
        return redirect()->route('product.index');
    }
}
