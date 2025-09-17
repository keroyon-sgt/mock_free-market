@php
    $title = '';
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')
<div class="item__alert">
    @if(session('message'))
    <div class="item__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="item__alert--danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>
    <div class="item__content">
        <ul class="section__tab">
            <li class="here-now">おすすめ</li>
    @if (Auth::check())
            <li>
                <button class="section__tab-button" onclick="location.href='/mypage'">マイリスト</button>
            </li>
    @else
            <li>
                <button class="section__tab-button" onclick="location.href='/login'">マイリスト</button>
            </li>
    @endif
        </ul>
<hr>
<!-- ------------------------------------------------- -->

<!-- ------------------------------------------------- -->
<!-- ------------------------------------------------- -->

    <div class="item-box__place">
        <ul class="item-box__list">
    @foreach ($items as $item)
            <li class="item-box">
    @if($item['stock'])
                <a href="{{ route('item',['item_id' => $item['id'] ]) }}">
    @endif

    @if(!$item['stock'])
                    <div class="item-box__sold">
                        <img src="{{ asset('img/sold.png') }}" alt="SOLD" />
                    </div>
    @endif
                    <div class="item-box__image">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
                    </div>
                    <div class="item-box__title">{{ $item['title'] }}</div>

    @if($item['stock'])
                </a>
    @endif
            </li>
    @endforeach
        </ul>
    </div>

@endsection
