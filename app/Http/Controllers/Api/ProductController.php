<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use JWTAuth;

class ProductController extends Controller
{
    //
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function index(Request $request)
    {
//        return $this->user
//            ->products()
//            ->get(['name', 'price', 'quantity'])
//            ->toArray();  & $request->has('date')

        $content =(new Product())->newQuery();

        if ($request->has('id') ){
            $id = $request->input('id');
            $content = Product::query()->where('id', '=', $id)->get();

            return response()->json([
                'success' => true,
                'data' => $content->toArray()
            ]);
        }

        if ($request->has('name') ){
            $name = $request->input('name');
            $content = Product::query()->where('name', 'LIKE', "%{$name}%")->get();

            return response()->json([
                'success' => true,
                'data' => $content->toArray()
            ]);
        }
        if ($request->has('date') & $request->has('type') & $request->has('town')) {
            $date = $request->input('date');
            $type = $request->input('type');
            $town = $request->input('town');
            $content = Product::query()
                ->where('date', 'LIKE', $date)
                ->where('type', '=', $type)
                ->where('town', '=', $town)->get();
            return response()->json([
                'success' => true,
                'data' => $content->toArray()
            ]);

        }
        $content = Product::query()->get();
        return response()->json([
            'success'=>true,
            'data'=>$content
                ->toArray()
        ]);

    }
//        if ($request ->has('type')) {
//
//
//            $content = Product::query()
//        }
//        if ($request ->has('town')) {
//
//
//            $content = Product::query()
//        }
//


//        if {
//            return response()->json([
//                'success'=>false,
//                'errorMessage'=> 'Sorry, product with cannot be found'
//            ],400);
//        }
//        return response()->json([
//            'success'=>true,
//                'data'=>$this->user
//                         ->products()
//                         ->get(['name','price','quantity','date'])
//                         ->toArray()
//        ]);



    public function ShowByDate($date){
        $product= $this->user->products()-find($date);

        if(!$product){
            return response()->json([
                'success'=> false,
                'message' =>'Sorry, product with date' . $date .'cannot be found'
            ],400);

        }
        return $product;
    }



    public function show($id)
    {
        $product = $this->user->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }

        return $product;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required|string',
            'type' => 'required|string',
            'town'     =>'required|string',
            'price'     =>'required|string',
            'weight_unit'     =>'required|string'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->date = $request->date;
        $product->type = $request->type;
        $product->town = $request->town;
        $product->price = $request->price;
        $product->weight_unit = $request->weight_unit;

        if ($this->user->products()->save($product))
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $product = $this->user->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }

        $updated = $product->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $product = $this->user->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }

        if ($product->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
            ], 500);
        }
    }
}
