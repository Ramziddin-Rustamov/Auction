<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\ProductRequest;
use App\Http\Resources\API\V1\ProductResource;
use Exception;
use Illuminate\Http\Request;
use OpenApi\Examples\UsingRefs\ProductResponse;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{

    public $error = [
        'message'=>'Not Found',
        'status'=>'error',
        'status_code'=>404
    ];
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product  = Product::paginate(10);
        return ProductResource::collection($product);
    }


    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, ProductRequest $productRequest)
    {
        $product =  Product::create($productRequest->validated());
        return new ProductResponse($product);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::find($product);
        if($product){
            return new ProductResource($product);
        }
        return $this->error;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // 
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $product,ProductRequest $productRequest)
    {
        $product = Product::find($product);
        if($product){
            $product->update($productRequest->validated());
            return new ProductResponse($product);
        }
        return $this->error;
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        try{
        $product = Product::find($product);
        if($product){
            $product->delete();
            return response()->json([
                'message'=>'Deleted successfully !',
                 'status'=>200
            ]);
        }
        return $this->error;
        }catch(Exception $e){
            return response()->json([
                'message'=>'You can\'nt delete this ! '
            ]);
        }
    }
}
