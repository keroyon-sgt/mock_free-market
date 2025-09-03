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
    <div class="item__left-column">
        <div>
            <div>
                <div class="item__image-wrapper">
                    <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}" />
                </div>
            </div>
            <div class="item__detail-place">
                <p class="item__header">
                    <h2>{{ $item['title'] }}</h2>
                    <div class="item__price">{{ $item['price'] }}</div>
                </p>
            </div>
        </div>
        <div>
            <div>支払方法</div>
            <div>
                <form class="form" action="/purchase" method="post">@csrf
                <select name="method" required>
                    <option value="" selected hidden>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード払い</option>
                </select>
            </div>
        </div>
        <div>
            <div><span>配送先</span>
                <div class="login__link">
                    <a class="login__button-submit" href="/purchase/address">変更する</a>
                </div>
            </div>
        </div>
    </div>
    <div class="item__right-column">
        <div>
            <table class="item__information">
                    <tr>
                        <th>商品代金</th>
                        <td>
                            <span class="item__category">{{ $item['price'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>支払方法</th>
                        <td>
                            if
                        </td>
                    </tr>
                </table>


            <div class="item__information">
                <div class="item__information-title">
                    <span class="">商品代金</span>
                </div>
                <div class="item__information-content">
                    <span class="item__category">foreach</span>
                </div>
            </div>
            <div class="item__information">
                <div class="item__information-title">
                    <span class="">支払方法</span>
                </div>
                <div class="item__information-content">
                        if
                </div>
            </div>

        </div>
        <div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">購入する</button>
            </div>
        </form>

        </div>



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