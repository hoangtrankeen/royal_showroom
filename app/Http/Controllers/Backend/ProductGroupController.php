<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Product\SaveGroupProductRequest;
use App\Http\Requests\Product\UpdateGroupProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductGroupController extends ProductController
{
    public function __construct(
        \App\Model\Product $product,
        \App\Http\BusinessLayer\MediaManager\ImageHandler $image_handler,
        \App\Model\Category $category,
        \App\Model\Attribute $attribute,
        \App\Model\ProductAttribute $product_attribute,
        \App\Model\AttributeValue $attribute_value
    )
    {
        parent::__construct(
            $product,
            $image_handler,
            $category,
            $attribute,
            $product_attribute,
            $attribute_value
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveGroupProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveGroupProductRequest $request)
    {
        $image_data = $this->image_handler->saveImages($this->img_product_dir,$request->images);

        $child_array = [];
        foreach (explode(',',$request->child_product) as $child) {
            $child_array[] = (int) $child;
        }


        $data = array_merge($request->all(),[
            'images' => $image_data,
            'child_id' => json_encode($child_array)
        ]);

        $product = $this->product->create($data);

        //Store Product - Category
        $product->categories()->sync($request->categories);

        // Store Parent Id
        $childArr =  json_decode($product->child_id);
        $childProduct = $this->product->whereIn('id', $childArr)->get();

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

            $this->product->find($child->id)->update([
                'parent_id' => json_encode($parent_id)
            ]);
        }

        Session::flash('success', 'The product was successfully save!');
        return redirect()->route('product-group.index');
    }

    public function update(UpdateGroupProductRequest $request, $id)
    {
        $product = $this->product->findOrFail($id);
        $image_data = $this->image_handler->updateImages($this->img_product_dir,$request->images, $product->images);
        $child_array = [];

        foreach (json_decode($request->child_product) as $child) {
            $child_array[] = (int) $child;
        }

        $data = array_merge($request->all(),[
            'images' => $image_data,
            'child_id' => json_encode($child_array)
        ]);

        $product->update($data);
        //Store Product - Category
        $product->categories()->sync($request->categories);

        // Store Parent Id
        $childArr =  json_decode($product->child_id);

        $childProduct = $this->product->whereIn('id', $childArr)->get();

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
            $this->product->find($child->id)->update([
                'parent_id' => json_encode($parent_id)
            ]);
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
