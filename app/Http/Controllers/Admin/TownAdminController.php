<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Town;
use Illuminate\Http\Request;

class TownAdminController extends Controller
{
    //
    public function index(){
        $towns = Town::all();
        return view('admin.towns.town_index',compact('towns'));
    }
    public function create(){
        return view('admin.towns.town_create');
    }

    public function edit(Town $town){
        return view('admin.towns.town_edit',compact('town'));
    }

    public function store(Request $request){
        Town::create($request->all());
        return redirect()->route('admin.towns.index');

    }
    public function update(Request $request,Town $town)
    {
        $town->update($request->all());
        return redirect()->route('admin.towns.index');
    }
    public function destroy(Town $town){

        $town->delete();
        return redirect()->route('admin.towns.index');

    }
}
