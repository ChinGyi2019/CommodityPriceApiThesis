<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;
use JWTAuth;
class TypeController extends Controller
{
    //
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request){

        if ($request->has('id') ){
            $id = $request->input('id');
            $content = Type::query()->where('id', '=', $id)->get();

            return response()->json([
                'success' => true,
                'data' => $content->toArray()
            ]);
        }

        $content = Type::query()->get();
        return response()->json([
            'success'=>true,
            'data'=>$content
                ->toArray()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'type' => 'required|integer',
            'name' => 'required|string'

        ]);

        $type = new Type();
        $type->name = $request->name;
        $type->type = $request->type;

        if ($this->user->types()->save($type))
            return response()->json([
                'success' => true,
                'type' => $type
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added'
            ], 500);
    }
}
