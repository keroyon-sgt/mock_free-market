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
            <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}" />
        </div>
    </div>
    <div class="item__detail-place">
        <p class="item__header">
            <h2>{{ $item['title'] }}</h2>
            <div class="item__brand">{{ $item['brand'] }}</div>
            <div class="item__price">{{ $item['price'] }}</div>
            <div class="item__responses">
                <div class="item__responses-likes">
                    ☆<br />
                    <span class="item__responses-count">item_like_count</span>
                </div>
                <div class="item__responses-comments">
                    💭<br />
                    <span class="item__responses-count">item_comment_count</span>
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
                        <span class="item__category">foreach</span>
                    </td>
                </tr>
                <tr>
                    <th>商品の状態</th>
                    <td>
                        if
                    </td>
                </tr>
            </table>




        <div class="item__information">
            <div class="item__information-title">
                <span class="">カテゴリー</span>
            </div>
            <div class="item__information-content">
                <span class="item__category">foreach</span>
            </div>
        </div>
        <div class="item__information">
            <div class="item__information-title">
                <span class="">商品の状態</span>
            </div>
            <div class="item__information-content">
                    if
            </div>
        </div>









            <div class="item__categories">
                {{ $item['id'] }}
                foreach
            </div>
            <div class="item__condition">
                {{ $item['id'] }}
                foreach
            </div>
        </p>
        <p class="item__comments">
            <h3>コメント($comments_count)</h3>
            foreach
            <div>
                <span class="item__comments-icon">
                    <img src="" alt="">
                </span>
                <span class="item__comments-name">
                    $username
                </span>
            </div>
            <div class="item__comment-form">
                <span class="comments-form__label">商品へのコメント</span>
                <form action="" method="">@csrf
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="" ></textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
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