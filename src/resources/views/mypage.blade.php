@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="mypage__content">

    <div>
        <div class="mypage__image">
            <img src="{{ asset('storage/' . $user->portrait_path) }}" alt="{{ $user['name'] }}" />
        </div>
    </div>
    <div class="mypage__detail">
        <p class="mypage__name">
            <h2>{{ $user['name'] }}</h2>
        </p>
    </div>
    <div>
        <button class="mypage__button-edit" onclick="location.href='/mypage/profile'">プロフィールを編集</button>

    </div>

    <ul class="section__tab">
        <li class="here-now">出品した商品</li>
@if (Auth::check())
        <li>
            <button class="section__tab-button" onclick="location.href='/mypage?page=buy'">購入した商品</button>
        </li>
@else
        <li>
            <button class="section__tab-button" onclick="location.href='/login'">購入した商品</button>
        </li>
@endif
        
    </ul>
<hr>

<!-- ------------------------------------------------- -->

    <div class="item-box__place">
        <ul class="item-box__list">
    @foreach ($items as $item)
            <li class="item-box">
                <a href="{{ route('item',['item_id' => $item['id'] ]) }}">
                    <div class="item-box__image">
                        <img src="{{  asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
                    </div>
                    <div class="item-box__title">{{ $item['title'] }}</div>
                </a>
            </li>
    @endforeach
        </ul>
    </div>




    <!-- ------------------------------------------------- -->


</div>
@endsection
