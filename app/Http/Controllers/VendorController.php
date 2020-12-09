<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Http\Resources\DishResource;
use App\Http\Resources\OrderResource;
use App\Vendor;
use App\Tag;
use App\Dish;
use App\Order;
use App\Http\Requests\VendorRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return VendorResource::collection(Vendor::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VendorRequest  $request
     * @return \Illuminate\Http\Response
     * created : 50 Minute
     */
    public function store(VendorRequest $request)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validate = $request->validated();
            
            $vendor = Vendor::create([
                'name'=>$request['name'],
                'logo'=>$request['logo'],
            ]);

            $tags = Tag::whereIn('name', $request['tag_name'])->get();
            collect($tags)->each(function($tags) use ($vendor) {
                $tags->vendors()->attach($vendor->id);
            });

            return new VendorResource(Vendor::where('id', $vendor->id)->first());
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
     * created: 5 Minute;
     */
    public function show($id)
    {
        try{
            $vendor = Vendor::where('id', $id)->first();
            return new VendorResource($vendor);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VendorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * created : 1 Hour
     */
    public function update(VendorRequest $request, $id)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validate = $request->validated();

            $vendor = Vendor::find($id);
            $vendor->name = $request['name'];
            $vendor->logo = $request['logo'];
            
            $tags = Tag::whereIn('name', $request['tag_name'])->get();
            // dd($tags);
            collect($tags)->each(function($tags) use ($vendor) {
                $tags->vendors()->sync([$vendor->id => ['tag_id' => $tags->id]]);
            });

            $vendor->save();
            return new VendorResource($vendor);
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
     * created: 3 Minute
     */
    public function destroy($id)
    {
        try{
            $vendor = Vendor::find($id)->delete();
            return ["data" => "succesfully delete"];
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Display the dishes provided by vendor
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function displayDishes($id)
    {
        try{
            $dish = Dish::where('vendor_id', $id)->get();
            return DishResource::collection($dish);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Display the order from vendor
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function displayOrders($id)
    {
        try{
            $orders = Order::where('vendor_id', $id)->get();
            return OrderResource::collection($orders);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }
}
