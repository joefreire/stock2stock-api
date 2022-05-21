<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
     /**
     * Return all items.
     *
     * @return json
     */
    public function showAll()
    {
        return response()->json(Product::all());
    }
    /**
    * Return some item.
    * 
    * @param  $sku
    * @return json
    */
    public function showOne($sku)
    {
        return response()->json(Product::where('sku',$sku)->firstOrFail());
    }
    /**
    * Create some item.
    * 
    * @param  App\Http\Requests\ProductStoreRequest  $request
    * @return json
    */
    public function create(ProductStoreRequest $request)
    {
        $added = [];
        foreach($request->all() as $item) {
            $product = Product::create($item);
            $added[] = $item;
        }       
        return response()->json($added, 201);
    }
    /**
    * Update some item.
    * 
    * @param  $sku, App\Http\Requests\ProductStoreRequest $request
    * @return json
    */
    public function update($sku, Request $request)
    {
        $product = Product::where('sku',$sku)->firstOrFail();
        $product->attributes = $request['attributes'];
        $product->update();
        return response()->json($product, 200);
    }
    /**
    * Delete some item.
    * 
    * @param  $sku
    * @return json
    */
    public function delete($sku)
    {
        $product = Product::where('sku',$sku)->delete();
        return response('Deleted Successfully', 200);
    }
}