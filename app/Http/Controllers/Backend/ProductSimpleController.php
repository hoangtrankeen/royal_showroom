<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Product\SaveSimpleProductRequest;
use App\Http\Requests\Product\UpdateSimpleProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductSimpleController extends ProductController
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
     * @param  SaveSimpleProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSimpleProductRequest $request)
    {
        //Store
        $this->saveProductData($request);
        Session::flash('success', 'The product was successfully save!');
        return redirect()->route('product-simple.index');
    }

    public function saveProductData($request)
    {
        $image_name = $this->image_handler->saveImages($this->img_product_dir,$request->images);

        $data = array_merge($request->all(),['images' => $image_name]);
        //Store Product Parent
        $product = $this->product->create($data);

        $product->categories()->sync($request->categories);

        $attributes = $this->attribute->all();

        foreach ($attributes as $attribute){
            if($request->has($attribute->inform_name)  && ($request->input($attribute->inform_name) !== null)){

                if($attribute->type == 'select'){
                    $attr_val_id = $request->input($attribute->inform_name);
                }
                elseif($attribute->type == 'text'){
                    $attr_text_val = $this->attribute->create([
                        'name' => $request->input($attribute->inform_name),
                        'attribute_id' => $attribute->id
                    ]);
                    $attr_val_id = $attr_text_val->id;
                }else{
                    continue;
                }
                $this->product_attribute->create([
                    'product_id' => $product->id,
                    'attribute_value_id' => $attr_val_id
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSimpleProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpleProductRequest $request, $id)
    {
        $product = $this->product->findOrFail($id);
        $image_data = $this->image_handler->updateImages($this->img_product_dir,$request->images, $product->images);
        $data = array_merge($request->all(),['images' => $image_data]);
        $product->update($data);

        //Store Product - Category
        $product->categories()->sync($request->categories);

        $attributes = $this->attribute->all();

        //Find in form the attribute field that match one's name in attribute table
        foreach ($attributes as $attribute){
            //If found a not null one
            if($request->has($attribute->inform_name)  && ($request->input($attribute->inform_name) !== null)){

                //Because each product just has 1 attribute that related to just 1 attribute value
                //Check if the attribute value (related to the product) exists in attribute value table (base on an exist attribute id above to find)
                //Then we always get just one
                $attr_value = $product->attributeValue()->where('attribute_value.attribute_id', $attribute->id)->first();
                // Found one
                if(!empty($attr_value)){

                    // Just update the new attribute value id of the pivot table when attribute type is select
                    if($attribute->type == 'select'){

                        $this->product_attribute->where('product_id',$product->id)
                            ->where('attribute_value_id', $attr_value->id)
                            ->update([
                            'attribute_value_id' => $request->input($attribute->inform_name)
                        ]);
                    }
                    // Just update name field of attribute value table
                    elseif($attribute->type == 'text'){
                        $this->attribute_value->where('id',$attr_value->id)->update([
                            'name' => $request->input($attribute->inform_name)
                        ]);
                    }else{
                        continue;
                    }
                // if not exist the only case, attribute is text type, then create a new text value and store a new row in pivot table
                }else{
                    if($attribute->type == 'select'){
                        $attr_val_id = $request->input($attribute->inform_name);
                    }
                    elseif($attribute->type == 'text'){
                        $attr_text_val = $this->attribute_value->create([
                            'name' => $request->input($attribute->inform_name),
                            'attribute_id' => $attribute->id,

                        ]);
                        $attr_val_id = $attr_text_val->id;
                    }else{
                        continue;
                    }
                    $this->product_attribute->create([
                        'product_id' => $product->id,
                        'attribute_value_id' => $attr_val_id
                    ]);
                }
            }
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
        $groups = $this->product->where('type_id', 'group')->get();
        $product = $this->product->findOrFail($id);

        $product->categories()->detach();
        $product->attributeValue()->detach();
        $product->orders()->detach();

        foreach($groups as $group)
        {
            $child_id = json_decode($group->child_id);

            if(is_array($child_id) ){
                $key = array_search($id,$child_id);

                if($key!==false){

                    unset($child_id[$key]);

                    $product->find($group->id)->update([
                        'child_id' => json_encode($child_id)
                    ]);
                }
            }
        }

        $this->image_handler->deleteImages($this->img_product_dir, $product->images);
        $product->delete();

        Session::flash('success', 'The product was successfully deleted!');
        return redirect()->route('product.index');
    }

    public function copy($id)
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

        $data['attributes'] = Attribute::all();

        if($product->type_id == 'simple'){
            return view('backend/product/copy-simple', $data);
        }

        Session::flash('error', 'The Product Type not exist');
        return redirect()->back();
    }

}
