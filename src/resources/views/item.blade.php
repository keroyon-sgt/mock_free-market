@php
    $title = '商品詳細　';
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="item__content">
    <div class="item__image-place">
        <div class="item__image-wrapper">
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
        </div>
    </div>
    <div class="item__detail-place">
        <div class="item__header">
            <h2 class="item__header-title">{{ $item['title'] }}</h2>
            <div class="item__brand">{{ $item['brand'] }}</div>
            <div class="item__price"><span class="item__price-yen">￥</span>{{ $item['price'] }}<span class="item__price-tax">（税込）</span></div>
            <div class="item__responses">
                <div class="item__responses-likes">
@if($duplication)
                        <img src="/img/star_on.png" alt="like" />
@else
                        <a href="/like/{{ $item->id }}">
                            <img src="/img/star_off.png" alt="like" />
                        </a>
@endif
                    <div class="item__responses-count">{{$likes_count}}</div>
                </div>
                <div class="item__responses-comments">
                    <img src="/img/balloon.png" alt="like" />
                    <div class="item__responses-count">{{$comments_count}}</div>
                </div>
            </div>
        </div>
        <div class="item__button-purchase">
            <button onclick=location.href="/purchase/{{ $item['id'] }}">購入手続きへ</button>
        </div>
        <div class="item__details">
            <h3>商品説明</h3>
            <div class="item__description">{{ $item['description'] }}</div>
            <h3>商品の情報</h3>

            <table class="item__information">
                <tr>
                    <th>カテゴリー</th>
                    <td>
                        <ul class="item__category">
                        @foreach ($category_list as $category)
                            <li>{{ $category }}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>商品の状態</th>
                    <td>
                        <div class="item__condition">
<?php
switch ($item['condition']) {
    case 'a':
        echo "良好";
        break;
    case 'b':
        echo "目立った傷や汚れなし";
        break;
    case 'c':
        echo "やや傷や汚れあり";
        break;
    case 'd':
        echo "状態が悪い";
        break;
}
?>
                        </div>
                    </td>
                </tr>
            </table>

        <div class="item__information">
            <div class="item__information-title">
                <span class="">カテゴリー</span>
            </div>
            <div class="item__information-content">
                <ul class="item__category">
                    @foreach ($category_list as $category)
                        <li>{{ $category }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="item__information">
            <div class="item__information-title">
                <span class="">商品の状態</span>
            </div>
            <div class="item__information-content">
<?php
switch ($item['condition']) {
    case 'a':
        echo "良好";
        break;
    case 'b':
        echo "目立った傷や汚れなし";
        break;
    case 'c':
        echo "やや傷や汚れあり";
        break;
    case 'd':
        echo "状態が悪い";
        break;
}
?>
            </div>
        </div>


        </div>
        <div>
            <h3>コメント({{$comments_count}})</h3>

            <ul class="item__comments">
    @foreach ($comments as $comment)
                <li>
                    <span class="item__comments-icon">
                        <img src="/storage/{{ $comment->user->portrait_path }}" alt="{{ $comment->user->name }}" />
                    </span>
                    <span class="item__comments-name">
                        {{ $comment->user->name }}
                    </span>
                    <div class="item__comments-text">{{ $comment->comment }}</div>
                </li>
    @endforeach
            </ul>

            <div class="item__comment-form">
                <span class="comments-form__label">商品へのコメント</span>
                <form action="/item/{{ $item->id }}" method="POST">@csrf
                    <div class="comments-form__textarea">
                        <textarea name="comment" placeholder="" ></textarea>
                    </div>
                    <div class="form__error">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__button">
                        <button class="comments-form__button" type="submit">コメントを送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection