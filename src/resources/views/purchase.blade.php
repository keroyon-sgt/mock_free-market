@php
    $title = '購入手続き　';
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('script')
<script type="text/javascript">

    // let selector = document.querySelector('#method');
    //     selector.addEventListener('change', (event) => {
    //     let box = document.querySelector('#purchase__confirm-method');
    //     box.textContent = event.target.value;
    // });

    // let element = document.getElementById( "method" ) ;
    //     element.onchange = function(){
    //     document.getElementById('purchase__confirm-method').textContent = this.value;
    // }

    let element = document.getElementById( "method" ) ;
        element.onchange = function(){
            if(this.value==1){
                method = 'コンビニ払い';
            }else if(this.value==2){
                method = 'カード払い';
            }else{
                method = '';
            }

        document.getElementById('purchase__confirm-method').textContent = method;
        document.getElementById('purchase__confirm-method2').textContent = method;
    }
</script>

@endsection




@section('content')
<?php

// echo '<br /><br />item = ';
// var_dump($item);
// exit;
?>

<div class="item__content">
    <div class="item__left-column">
        <div class="item__image-place">
            <div class="item__image-wrapper">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
            </div>
            <div class="item__detail-place">
                <p class="item__header">
                    <h2>{{ $item['title'] }}</h2>
                    <div class="item__price"><span class="item__price-yen">￥</span>{{ $price_formed }}</div>
                </p>
            </div>
        </div>
        <div class="item__method-place">
            <h3>支払い方法</h3>
            <div>
                <form action="/purchase" method="post">
                    @csrf
                <input type="hidden" name="item_id" value="{{ $item['id'] }}" />

                <select name="method" id="method" required>
                    <option value="" selected hidden>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード払い</option>
                </select>
            </div>
        </div>
        <div class="item__delivery-place">
            <div class="item__delivery-header">
                <h3>配送先</h3>
                <div class="item__delivery-edit">
                    <a class="login__button-submit" href="/purchase/address">変更する</a>
                </div>
            </div>
            <div class="item__delivery-content">
                <div>〒{{ $delivery['postal_code'] }}</div>
                <div>{{ $delivery['address'] }}</div>
                <div>{{ $delivery['building'] }}</div>
            </div>
            <input type="hidden" name="postal_code" value="{{ $delivery['postal_code'] }}" readonly />
            <input type="hidden" name="address" value="{{ $delivery['address'] }}" readonly />
            <input type="hidden" name="building" value="{{ $delivery['building'] }}" readonly />
        </div>
    </div>
    <div class="item__right-column">
        <div>
            <table class="item__information">
                    <tr>
                        <th>商品代金</th>
                        <td>
                            <span class="purchase__confirm"><span class="item__price-yen">￥</span>{{ $price_formed }}</span>
                            <input type="hidden" name="price" value="{{ $item['price'] }}" readonly />
                        </td>
                    </tr>
                    <tr>
                        <th>支払方法</th>
                        <td>
                            <div class="purchase__confirm" id="purchase__confirm-method">支払方法を<br />選択してください</div>
                        </td>
                    </tr>
                </table>


            <!-- <div class="item__information">
                <div class="item__information-title">
                    <span class="">商品代金</span>
                </div>
                <div class="item__information-content">
                    <span class="item__category">{{ $item['price'] }}</span>
                </div>
            </div>
            <div class="item__information">
                <div class="item__information-title">
                    <span class="">支払方法</span>
                </div>
                <div class="item__information-content">
                        if
                </div>
                <div class="purchase__confirm" id="purchase__confirm-method2">選択してください</div>
            </div> -->

        </div>
            <div class="item__button-purchase" >
                <button type="submit">購入する</button>
            </div>
        </form>

        </div>



    </div>
</div>

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