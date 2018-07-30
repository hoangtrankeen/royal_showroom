<?php

namespace App\Http\Controllers\Backend;

use App\Model\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderStatusController extends Controller
{
    protected $order_status;

    public function __construct(
        OrderStatus $orderStatus
    )
    {
        $this->order_status = $orderStatus;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_statuses = $this->order_status->all();
        return view('backend/content/order_status/index', compact('order_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/content/order_status/create');
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
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:order_statuses,code',
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->order_status->create($request->all());
        Session::flash('success', 'Trạng thái đơn hàng đã được tạo!');
        return redirect()->route('order-status.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_status = $this->order_status->findOrFail($id);
        return view('backend/content/order_status/edit',compact('order_status'));
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
            'code'          => 'required|regex:/^[a-zA-Z-]+$/u|alpha_dash|unique:order_statuses,code,'.$id,
            'details'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'active'        => 'required|boolean'
        ]);

        $this->order_status->findOrFail($id)->update($request->all());
        Session::flash('success', 'Trạng thái đơn hàng đã được cập nhật!');
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
        $this->order_status->findOrFail($id)->delete();
        return redirect()->route('order-status.index');
    }
}
