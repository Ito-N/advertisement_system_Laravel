@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                @include('sidebar')
            </div>
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @foreach ($errors->all() as $errorMessage)
                            <li>{{ $errorMessage }}</li>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('ads.update',$ad->id) }}" method="post" enctype="multipart/form-data">@csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header text-white" style="background-color: red">
                            広告の更新
                        </div>
                        <div class="card-body">
                            <label for="file" class="mt-2"><b>カテゴリーごとに3つの画像を選択</b></label>
                            <div class="form-inline form-group mt-1">
                                <div class="col-md-4">
                                    <image-preview />
                                </div>
                                <div class="col-md-4">
                                    <first-image />
                                </div>
                                <div class="col-md-4">
                                    <second-image />
                                </div>
                            </div>
                            <label for="file" class="mt-2"><b>カテゴリーの選択</b></label>
                            <div class="form-inline form-group mt-1">
                                <category-drop-down />
                            </div>

                            <div class="form-group">
                                <label for="name">名前</label>
                                <input type="text" name="name" class="form-control" value="{{$ad->name}}">
                            </div>
                            <div class="form-group">
                                <label for="description">詳細</label>
                                <textarea name="description" id="mytextarea" class="form-control">{{$ad->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">価格(¥)</label>
                                <input type="text" name="price" class="form-control" value="{{$ad->price}}">
                            </div>
                            <div class="form-group">
                                <label for="description">価格のステータス</label>
                                <select class="form-control" name="price_status">
                                    <option value="negoitable" {{$ad->price_status == "negoitable" ? 'selected' : ''}}>交渉可</option>
                                    <option value="fixed" {{$ad->price_status == "fixed" ? 'selected' : ''}}>固定価格</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">商品の状態</label>
                                <select class="form-control" name="product_condition">
                                    <option value="">選択 </option>
                                    <option value="likenew" {{$ad->product_condition == "likenew" ? 'selected' : ''}}>中古商品-非常に良い</option>
                                    <option value="heavilyused" {{$ad->product_condition == "heavilyused" ? 'selected' : ''}}>中古商品</option>
                                    <option value="new" {{$ad->product_condition == "new" ? 'selected' : ''}}>新品</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">掲載場所</label>
                                <input type="text" class="form-control" name="listing_location" value="{{$ad->listing_location}}">
                            </div>
                            <label for="file" class="mt-2"><b>アドレスを選択</b></label>
                            <div class="form-inline form-group mt-1">
                                <address-drop-down />
                            </div>
                            <div class="form-group">
                                <label for="location">販売者の連絡先番号</label>
                                <input type="number" class="form-control" name="phone_number" value="{{$ad->phone_number}}">
                            </div>
                            <div class="form-group">
                                <label for="location">商品のデモリンク（youtubeなど）</label>
                                <input type="text" class="form-control" name="link" value="{{$ad->link}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger float-right" type="submit">広告の更新</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
