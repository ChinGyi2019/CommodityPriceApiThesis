<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Town;
use Illuminate\Http\Request;
use JWTAuth;

class TownController extends Controller
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
            $content = Town::query()->where('id', '=', $id)->get();

            return response()->json([
                'success' => true,
                'data' => $content->toArray()
            ]);
        }

        $content = Town::query()->get();
        return response()->json([
            'success'=>true,
            'data'=>$content
                ->toArray()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string',


        ]);

        $town = new Town();
        $town->name = $request->name;


        if ($this->user->towns()->save($town))
            return response()->json([
                'success' => true,
                'product' => $town
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added'
            ], 500);
    }
}
