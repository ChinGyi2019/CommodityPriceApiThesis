<?php
namespace App\Http\Controllers;
use App\Town;
use App\Type;
use Illuminate\Http\Request;
use App\Product;
use DataTables;


class ProductAjaxController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {

   // $products  = Product::select('name', 'detail');
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        $towns = Town::all();
        $types = Type::all();
        //return view('ProductAjax', compact('products'));
       return view('ProductAjax',compact(['towns','types']));
        return View::make('ProductAjax')
            ->with(compact('towns'))
            ->with(compact('types'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        Product::updateOrCreate(['id' => $request->product_id],

            [   'name'   => $request->name,
                'date'   => $request->get('date'),
                'type'   => $request->type,
                'town'   => $request->town,
                'price' => $request->price,
                'weight_unit' => $request->weight_unit
            ]);

        return response()->json(['success'=>'Product saved successfully.']);

    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $product = Product::find($id);

        return response()->json($product);

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        Product::find($id)->delete();



        return response()->json(['success'=>'Product deleted successfully.']);

    }

}
