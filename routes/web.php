<?php

use App\Vendor;
use App\Http\Resources\VendorResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route to enable query parameter
// based on https://github.com/spatie/laravel-query-builder
//
Route::get('vendors/search', function() {
    $vendor = QueryBuilder::for(Vendor::class)
                            ->allowedFilters([AllowedFilter::exact('name'), 'tags.name'])
                            ->get();
    return VendorResource::collection($vendor);
});
