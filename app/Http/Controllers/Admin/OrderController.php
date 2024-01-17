<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderby('created_at','desc')
                        ->with('customer')->with('shipping_country')->with('shipping_state')->with('shipping_township')
                        ->with('different_shipping_country')->with('different_shipping_state')->with('different_shipping_township')
                        ->get();
        //dd($orders->toArray());
        return view('admin.order.list',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = $order->load('items.product');
        //dd($order->toArray());
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // validate the request data
    $validatedData = $request->validate([
        'payment_status' =>'required|in:paid,unpaid,overdue',
        'status' => 'required|in:pending,processing,shipped,delivered,canceled,completed,failed',

        // add more validation rules as needed
    ]);
    logger($validatedData);
    // update the order with the new data
    $order->update($validatedData);

     //redirect back to the orders index page
    return redirect()->route('admin#orderlist')->with('update', 'Order updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //multiple item delete
    public function bulkAction(Request $request)
{
    $action = $request->input('action');

    if ($action === 'delete') {
        $selectedIds = $request->input('selectedIds', []);

        // Perform the deletion logic using the selected IDs
        Order::whereIn('id', $selectedIds)->delete();

        return redirect()->back()->with('success', 'Selected items deleted successfully.');
    }

    // Handle other bulk actions if needed

    return redirect()->back()->with('error', 'Invalid action.');
}
}
