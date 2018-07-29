<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    protected $type;
    protected $attribute;
    protected $attribute_value;


    public function __construct(
        \App\Model\Attribute $attribute,
        \App\Model\AttributeValue $attribute_value
    )
    {
        $this->attribute = $attribute;
        $this->attribute_value = $attribute_value;
        $this->type = $this->attribute->availableAttributeType();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->attribute->all();
        return view('backend/content/attribute/index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attr_types = $this->type;
        return view('backend/content/attribute/create',compact('attr_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $types = implode(",", $this->type);
        $this->validate($request, array(
            'name'           => 'required|max:190',
            'type'           => 'required|max:190|in:'.$types,
            'inform_name'    => 'required|alpha_dash|min:5|max:255|unique:attributes,inform_name',
            'active'         => 'required|boolean',
        ));
        $attribute = $this->attribute->create($request->all());

        // Get Attribute value in form
        if($request->type == 'select'){
            $i = 0;
            while ($request->has('attr_value_'.($i+1)) && $request->input('attr_value_'.($i+1)) !== null && is_integer((int)$request->input('attr_value_'.($i+1)))) {
                $this->attribute_value->create([
                    'attribute_id' => $attribute->id,
                    'name' => $request->input('attr_value_'.($i+1))
                ]);
                $i++;
            }
        }

        Session::flash('success', 'The attribute was successfully save!');
        return redirect()->route('attribute.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = $this->attribute->findOrFail($id);
        $attr_types = $this->type;
        return view('backend/content/attribute/edit', compact('attribute', 'attr_types'));
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
        //$types = implode(",", $this->type);
        $this->validate($request, array(
            'name'   => 'required|max:190',
            'active'   => 'required|boolean',
            'inform_name'   => 'required|alpha_dash|min:5|max:255|unique:attributes,inform_name,'.$id,
        ));

        $attribute = $this->attribute->findOrFail($id);
        $attribute->update([
            'name' => $request->name,
            'active' => $request->active,
            'inform_name' => $request->inform_name
        ]);

        // Get Attribute value in form
        if($request->type == 'select'){
            foreach($attribute->attributeValue as $value){
                if ($request->has('attr_value_'.$value->id) && $request->input('attr_value_'.$value->id) !== null && is_integer((int)$request->input('attr_value_'.$value->id))) {
                    if(!empty($attribute->attributeValue)){
                        $this->attribute_value->where('id', $value->id)
                            ->where( 'attribute_id', $attribute->id)
                            ->update([
                                'name' => $request->input('attr_value_'.$value->id)
                            ]);
                    }
                }else{
                    $del_attr = $this->attribute_value->findOrFail($value->id);
                    $del_attr->product()->detach();
                    $del_attr->delete();
                }
            }


            $i = $attribute->attributeValue()->count();
            while ($request->has('new_attr_value_'.($i+1)) && $request->input('new_attr_value_'.($i+1)) !== null && is_integer((int)$request->input('new_attr_value_'.($i+1)))) {

                $this->attribute_value->create([
                    'attribute_id' => $attribute->id,
                    'name' => $request->input('new_attr_value_'.($i+1))
                ]);

                $i++;
            }
        }
        Session::flash('success', 'The attribute was successfully save!');
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
        $attribute = $this->attribute->findOrFail($id);
        foreach($attribute->attributeValue as $value)
        {
            $value->product()->detach();
            $value->delete();
        }

        $attribute->delete();
        Session::flash('success', 'This attribute was successfully deleted');
        return redirect()->route('attribute.index');
    }
}
