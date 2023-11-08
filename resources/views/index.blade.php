@extends('layouts.app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">自動販売機</h2>
            </div>
            <div>
                <form action="{{ route('product.index') }}" method="GET">
                @csrf
                    <input type="text" name="keyword">
                    <input type="submit" value="検索">
                </form>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー</th>
            <th>詳細表示</th>
            <th>削除</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td><img style="width:80px;" src="{{asset($products->img_path)}}" ></td>
            <td style="text-align:right">{{ $product->product_name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->stock }}</td>
            <td style="text-align:right">{{ $product->company_id }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('product.show') }}">詳細</a> 
            </td>
            <td>
                <form  class="id">
                    <input data-user_id="{{$companie->id}}" type="submit" class="btn btn-danger btn-dell" value="削除">
                </form>
        </tr>
        @endforeach
    </table>
 
@endsection