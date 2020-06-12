<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Type;
use Illuminate\Http\Request;

class TypeAdminController extends Controller
{
    //
    public function index(){
        $types = Type::all();
        return view('admin.types.type_index',compact('types'));
    }
    public function create(){
        return view('admin.types.type_create');
    }

    public function edit(Type $type){
        return view('admin.types.type_edit',compact('type'));
    }

    public function store(Request $request){
        Type::create($request->all());
        return redirect()->route('admin.types.index');

    }
    public function update(Request $request,Type $type)
    {
        $type->update($request->all());
        return redirect()->route('admin.types.index');
    }
    public function destroy(Type $type){

        $type->delete();
        return redirect()->route('admin.types.index');

    }
}
