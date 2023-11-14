<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Companie;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $products)
    {
        $products = Product::latest()->paginate(5);
       return view('index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = companie::all();
        return view('create')
        ->with('companies',$companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:20',
            'companies_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'mage' => 'image|max:1024'
            ]);

            $product = new Product();
            
            $product->company_id = $request->companies_id;
            $product->product_name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;

            if($request->image){
                $original = request()->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->move('storage/images',$name);
                $product->img_path = $name;
            }

            $product->save();
            return redirect()->route('product.index')
            ->with('message','商品を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $companies = Companie::all();
        return view('edit',compact('product'))
        ->with('companies',$companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
