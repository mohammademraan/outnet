<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderList = OrderList::all();

        return view('admin.orders-list', compact('orderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-orders-list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $order = new OrderList();
        $order->title = $validatedData['title'];
        $order->price = $validatedData['price'];
        $order->description = $validatedData['description'] ?? null;
        $order->status = 'Active';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('OrderImages'), $imageName);
            $order->image = $imageName;
        }

        $order->save();

        return redirect()->route('admin.orderlists.index')->with('order_success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(OrderList $orderList)
    {
        return redirect()->route('admin.orderlists.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderList $orderList)
    {
        return view('admin.edit-orders-list', compact('orderList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderList $orderList)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $orderList->title = $validatedData['title'];
        $orderList->price = $validatedData['price'];
        $orderList->description = $validatedData['description'] ?? null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('OrderImages'), $imageName);
            $orderList->image = $imageName;
        }

        $orderList->save();

        return redirect()->route('admin.orderlists.index')->with('order_success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderList $orderList)
    {
        $orderList->delete();

        return redirect()->route('admin.orderlists.index')->with('order_success', 'Order deleted successfully.');
    }
}
