<?php

namespace App\Http\Controllers\Backend;

use App\Model\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentMethodController extends Controller
{
    protected $payment_method;

    public function __construct(
        PaymentMethod $paymentMethod
    )
    {
        $this->payment_method = $paymentMethod;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = $this->payment_method->all();
        return view('backend/content/payment_method/index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/content/payment_method/create');
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
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:payment_methods,code',
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->payment_method->create($request->all());
        Session::flash('success', 'Phương thức thanh toán đã được tạo!');
        return redirect()->route('payment-method.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_method = $this->payment_method->findOrFail($id);
        return view('backend/content/payment_method/edit',compact('payment_method'));
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
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:payment_methods,code,'.$id,
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->payment_method->findOrFail($id)->update($request->all());
        Session::flash('success', 'Phương thức thanh toán đã được cập nhật!');
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
        $this->payment_method->findOrFail($id)->delete();
        return redirect()->route('payment-method.index');
    }
}
