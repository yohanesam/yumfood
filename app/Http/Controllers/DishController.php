<?php

namespace App\Http\Controllers;
use App\Dish;
use App\Http\Requests\DishRequest;
use App\Http\Resources\DishResource;
use Illuminate\Http\Request;

// Created 15 Minute

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DishResource::collection(Dish::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validated = $request->validated();

            $dish = Dish::create([
                'vendor_id'=>$request['vendor_id'],
                'dish_name'=>$request['dish_name'],
            ]);

            return new DishResource($dish);
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
            $dish = Dish::where('id', $id)->get();
            return new DishResource($dish);
        } catch(Exception $e) {
            return ["message" => $e];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(DishRequest $request, $id)
    {
        try{
            // Must add Accept: application/json
            // in the Header to works properly
            $validated = $request->validated();

            $dish = Dish::find($id);
            $dish->dish_name = $request['dish_name'];

            $dish->save();
            return new DishResource($dish);
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
        try{
            $vendor = Dish::find($id)->delete();
            return ["data" => "succesfully delete"];
        } catch(Exception $e) {
            return ["data" => $e];
        }
    }
}
