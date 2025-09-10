@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')
<?php

// echo '<br /><br />item = ';
// var_dump($item);
// exit;
?>

<div class="item__content">
    <div class="item__image-place">
        <div class="item__image-wrapper">
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
        </div>
    </div>
    <div class="item__detail-place">
        <p class="item__header">
            <h2>{{ $item['title'] }}</h2>
            <div class="item__brand">{{ $item['brand'] }}</div>
            <div class="item__price">{{ $item['price'] }}</div>
            <div class="item__responses">
                <div class="item__responses-likes">
@if($duplication)
                        <a href="/like/{{ $item->id }}">☆</a>
@else
                        ★
@endif
                    <br />
                    <span class="item__responses-count">{{$likes_count}}</span>
                </div>
                <div class="item__responses-comments">
                    💭<br />
                    <span class="item__responses-count">{{$comments_count}}</span>
                </div>
            </div>
        </p>
        <p class="item__button-purchase">
            <button onclick=location.href="/purchase/{{ $item['id'] }}">購入手続きへ</button>
        </p>
        <p class="item__details">
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


        </p>
        <p class="item__comments">
            <h3>コメント({{$comments_count}})</h3>

                <ul>
            @foreach ($comments as $comment)
                        <li>
                            <span class="item__comments-icon">
                                <img src="/storage/{{ $comment->user->portrait_path }}" alt="{{ $comment->user->name }}" />
                            </span>
                            <span class="item__comments-name">
                                {{ $comment->user->name }}
                            </span>
                            <div>{{ $comment->comment }}</div>
                        </li>
            @endforeach
                </ul>
            
            @foreach ($comments as $comment)
            <div>
                <span class="item__comments-icon">
                    <img src="/storage/{{ $comment->user->portrait_path }}" alt="{{ $comment->user->name }}" />
                </span>
                <span class="item__comments-name">
                    {{ $comment->user->name }}
                </span>
                <div>{{ $comment->comment }}</div>
            </div>
            @endforeach
            
            
            <div class="item__comment-form">
                <span class="comments-form__label">商品へのコメント</span>
                <form action="/item/{{ $item->id }}" method="POST">@csrf
                    <div class="form__input--textarea">
                        <textarea name="comment" placeholder="" ></textarea>
                    </div>
                    <div class="form__error">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__button">
                        <button class="form__button-submit" type="submit">コメントを送信する</button>
                    </div>
                </form>

            </div>




        </p>

    </div>


</div>

<hr>
<!-- ------------------------------------------------------------ -->


    <!-- @if(session('success'))
        <div id="alert-message" class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div id="alert-messages" class="alert alert-danger">
            <ul>
        @foreach ($errors->all() as $error_num=>$error)
            <li>{{ $error_num }} &nbsp;{{ $error }}</li>
        @endforeach
            </ul>
        </div>
    @endif 
@error('correct')
    {{ $message }}
@enderror -->


@endsection