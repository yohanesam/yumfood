<?php

namespace App\Http\Controllers;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderList;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

// Created 80 Minute

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return OrderResource::collection(Order::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validate = $request->validated();

            $order = Order::create([
                'recipient'=>$request['recipient'],
                'vendor_id'=>$request['vendor_id'],
            ]);
    
            foreach($request['order_list'] as $order_list) {
                $create_order = OrderList::create([
                    'dish_id'=>$order_list['dish_id'],
                    'order_id'=>$order->id,
                    'amount'=>$order_list['amount'],
                    'add_request'=>$order_list['add_request'],
                ]);
            }
    
            $all_order = Order::with('order_list')->find($order->id);
            return new OrderResource($all_order);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        try{
            $order = Order::with('order_list')->find($id);
            return new OrderResource($order);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Update the specified order list in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(OrderRequest $request, $id)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validate = $request->validated();
            
            foreach($request['order_list'] as $new_order_list) {
                $order_list = OrderList::find($new_order_list['id']);
                $order_list->update([
                    'dish_id'=>$new_order_list['dish_id'],
                    'order_id'=>$new_order_list['order_id'],
                    'amount'=>$new_order_list['amount'],
                    'add_request'=>$new_order_list['add_request'],
                ]);
            }
            
            $order = Order::with('order_list')->find($id);
            $order->recipient = $request['recipient'];
            $order->save();
            return new OrderResource($order);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        // 
    }
}
