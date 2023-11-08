@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="font-size:1rem;">商品新規登録画面</h2>
            </div>
        </div>
    </div>
    
    <div style="text-align:right;">
        <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="商品名">
                @error('name')
                    <span style="color:red;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <select name="sale" class="form-select">
                    <option>分類を選択してください</otion>
                    @foreach ($companies as $companie)
                        <option value="{{ $companie->id }}">{{ $companie->product_id }}</otion>
                    @endforeach
                </select>
                @error('company_id')
                    <span style="color:red;">分類を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                    <span style="color:red;">価格を数値で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="stock" class="form-control" placeholder="在庫数">
                @error('stock')
                    <span style="color:red;">在庫数を入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
                    <span style="color:red;">コメントを入力してください</span>
            @enderror
            </div>
        </div>
        <div class="image-table">
            <tr>
                <!-- <td><img  name="img_path"class="ju_image" src="#" alt="image">商品画像</td>
                <td><input id="image" type="file" name="image" ></td> -->
                <form method="POST" action="/" enctype="multipart/form-data">
                 @csrf
                    <input type="file" name="image">
                </form>
            </tr>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
        
        
        <div class="col-12 mb-2 mt-2">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
    </div>
</form>
@endsection