<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use DB;

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
        $products = DB::table('products')
        ->leftJoin('products_attributs', 'products.sku', '=', 'products_attributs.sku')
        ->where('products.sku',$sku)
        ->get();
        $attributes = [];
        
        foreach ($products as $index => $product) {  
            if(!isset($attributes[$product->sku])) {
                $attributes[$product->sku] = [];
            }            
            $attributes[$product->sku][] = [$product->attribute=>$product->value];
        }
        $result = [];
        foreach ($attributes as $attribute => $value) {  
            $result[]=['sku'=> $attribute, 'attributes' => $value];
        }
        return response()->json($result);
    }
    /**
    * Create some item.
    * 
    * @param  App\Http\Requests\ProductStoreRequest  $request
    * @return json
    */
    public function create(Request $request)
    {
        $products = $this->tasteData(100);
        $microtime = microtime(true);
        $added = [];
        $sqlProduct = 'INSERT INTO products (`sku`) values ';
        $sqlAttributes = 'INSERT INTO products_attributs (`sku`,`attribute`,`value`) values ';
        foreach($products as $item) {
            foreach ($item['attributes'] as $attribute => $value) {
                $sqlAttributes .= '( "'.$item['sku'].'","'.$attribute.'","'.$value.'" ),';
                //$attribute = DB::table('products_attributs')->insert([
                //    'sku'=>$item['sku'],
                //    'attribute'=>$attribute,
                //    'value'=>$value
                //]);
            }
            $sqlProduct .= '( "'.$item['sku'].'" ),';
            //$product = Product::create($item);
            $added[] = $item;
        }
        $sqlProduct = rtrim($sqlProduct, ',');
        $sqlAttributes = rtrim($sqlAttributes, ',');
        DB::unprepared($sqlProduct);
        DB::unprepared($sqlAttributes);
        $microtimeEnd = microtime(true);
        $totalTime = $microtimeEnd - $microtime;
        return response()->json($totalTime, 201);
    }
    public function tasteData($number) {
        $product = [];
        for ($i=0; $i < $number ; $i++) { 
            $product[] = ['sku'=>microtime().'-'.$i , 'attributes' =>['color'=>'blue']];
        }
        return $product;
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