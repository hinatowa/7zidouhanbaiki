@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="font-size:1rem;">商品情報詳細画面</h2>
            </div>
        </div>
    </div>
    
    <div style="text-align:left;">
        <!-- <form  action="{{ route('product.edit',$product->id) }}"  method="POST" enctype="multipart/form-data">
         @method('PUT')
         @csrf -->
        
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>ID:{{ $product->id }}</p>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>商品画像:<img style="width:80px;" src="{{asset('storage/'.$product->img_path)}}" ></p>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>商品名:{{ $product->product_name }}</p>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>メーカー:  @foreach ($companies as $companie)
                                @if ($companie->id==$product->company_id) {{ $companie->company_name }} @endif
                             @endforeach
                </p>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>価格:{{ $product->price }}</p>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>在庫数:{{ $product->stock }}</p>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <p>コメント:{{ $product->comment }}</p> 
            </div>
        </div>
    </div>
        <div class="col-12 mb-2 mt-2">
            <a class="btn btn-success" href="{{ url('/product.edit') }}">編集</a>
        </div>
        
        
        <div class="col-12 mb-2 mt-2">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
    </div>
</form>
@endsection



