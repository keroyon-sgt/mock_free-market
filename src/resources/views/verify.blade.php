@extends('layouts.app_simpleHeader')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="register-form__content">
    <div class="register-form__heading">
        <p>登録していただいたメールアドレスに認証メールを送付しました。<br />メール認証を完了してください。</p>
    </div>
    <form class="form" action="/verification" method="get">
        @csrf
        <input type="hidden" name="path(kari)" value=" " />
        <div class="form__button">
            <button class="form__button-submit" type="submit">認証はこちらから</button>
        </div>
    </form>
    <div class="login__link">
        <a class="login__button-submit" href="/login">認証メールを再送する</a>
    </div>
</div>
@endsection
