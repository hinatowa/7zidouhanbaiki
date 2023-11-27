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
    public function index(Request $request)
    {

         /* テーブルから全てのレコードを取得する */
         $products = Product::query();
         $companies = companie::all();


         /* キーワードから検索処理 */
         $keyword = $request->input('keyword');
         if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
             $products->where('product_name', '=', "%{$keyword}%");
             }

         $companies_name = $request->input('companies_name');
         if(!empty($companies_name)) {//$keyword　が空ではない場合、検索処理を実行します
             $companies->where('company_name', '=', "{$companies_name}")
             ->get();
             }
             
         $products = $products->paginate(5);
        // $products = Product::latest()->paginate(5);
       return view('index',compact('products'))
       ->with('companies',$companies);
       
    }

    // public function index(Product $products)
    // {
    //     $products = Product::latest()->paginate(5);
    //    return view('index',compact('products'));
       
    // }

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
    public function show(Product $product)
    {
        $companies = Companie::all();
        return view('show',compact('product'))
        ->with('companies',$companies);
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
    public function update(Request $request,Product $product)
    {
        $request->validate([
            'name' =>'required|max:20',
            'companies_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
            'mage' => 'image|max:1024'
            ]);

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

            return redirect()->route('product.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
        ->with('success'.$product->name.'を削除しました');
    }
}
