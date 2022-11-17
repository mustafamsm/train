<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as productResources;
use App\Http\Controllers\API\BaseController as BaseController;
use function PHPUnit\Framework\isNull;

class ProductController extends BaseController
{
        
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(productResources::collection($products),
            'All products sent');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $product = Product::create($input);

        return $this->sendResponse(new productResources($product), 'Product  created successfully');
    }

    public function show($id)
    {
            $product=Product::find($id);
            if(!$product){
                return $this->sendError('product Not found'  );

            }
        return $this->sendResponse(new productResources($product), 'Product  found successfully');

    }




    public function update(Request $request,Product $product)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->price = $input['price'];
        $product->save();
        return $this->sendResponse(new productResources($product), 'Product  created successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(new productResources($product), 'Product  deleted successfully');

    }
}
