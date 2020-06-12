<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxdataController extends Controller
{
    //
    function index()
    {
        return view('ajaxdata');
        //http://127.0.0:8000/ajaxdata
    }

    function getdata()
    {
        $students = Student::select('first_name', 'last_name');
        return Datatables::of($students)->make(true);
    }
}
