@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<!-- for bootstrap-4 -->
<!-- <script src="https://cdn.tailwindcss.com"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<!-- 
<script type="text/javascript">
$(function () {
    $('.js-open').click(function () {
        $("body").addClass("no_scroll"); // 背景固定させるクラス付与
        var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
        $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
    });
    // オーバーレイクリックでもモーダルを閉じるように
    $('.js-close ').click(function () {     //, #overlay
        $("body").removeClass("no_scroll"); // 背景固定させるクラス削除
        $('#overlay, .modal-window').fadeOut();
    });
});
</script> -->


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
                <a href="{{ route('item',['item_id' => $item['id'] ]) }}">
    @if(!$item['stock'])
                    <div class="item-box__sold">
                        <img src="{{ asset('img/sold.png') }}" alt="SOLD" />
                    </div>
    @endif
                    <div class="item-box__image">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item['title'] }}" />
                    </div>
                    <div class="item-box__title">{{ $item['title'] }}</div>
                </a>
            </li>
    @endforeach
        </ul>
    </div>




    <!-- ------------------------------------------------- -->


<?php

// switch ($item['gender']) {
//     case 1:
//         echo "男性";
//         break;
//     case 2:
//         echo "女性";
//         break;
//     case 3:
//         echo "その他";
//         break;
// }

?>

<!-- 
@foreach ($items as $item)

<?php

// var_dump($item);
// var_dump($categories);
// var_dump($category_list);
?>
<!-- @endforeach -->
<!-- 
old=
{{ old('keyword') }}
req=

<?php


?>
 -->

<?php
// echo'<br />Auth check =';
// var_dump(Auth::check());
?>


@endsection
