<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShippingMethodController extends Controller
{
    protected $shipping_method;

    public function __construct(
        \App\Model\ShippingMethod $shippingMethod
    )
    {
        $this->shipping_method = $shippingMethod;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_methods = $this->shipping_method->all();
        return view('backend/content/shipping_method/index', compact('shipping_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/content/shipping_method/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string|max:255',
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:shipping_methods,code',
            'price'          => 'required|integer',
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->shipping_method->create($request->all());
        Session::flash('success', 'Phương thức vận chuyển đã được tạo!');
        return redirect()->route('shipping-method.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping_method = $this->shipping_method->findOrFail($id);
        return view('backend/content/shipping_method/edit',compact('shipping_method'));
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
        $this->validate($request, [
            'name'          => 'required|string|max:255',
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:shipping_methods,code,'.$id,
            'price'         => 'required|integer',
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->shipping_method->findOrFail($id)->update($request->all());
        Session::flash('success', 'Phương thức vận chuyển đã được cập nhật!');
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
        $this->shipping_method->findOrFail($id)->delete();
        return redirect()->route('shipping-method.index');
    }
}
