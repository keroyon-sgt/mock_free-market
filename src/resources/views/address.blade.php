@php
    $title = '住所の変更　';
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="register-form__content">
    <div class="register-form__heading">
        <h2>住所の変更</h2>
    </div>
    <form class="form" action="/purchase/address" method="post">@csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-postal">
                    <input type="text" name="postal_code" value="{{ $delivery['postal_code'] }}" />
                </div>
                <div class="form__error">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- --------------- -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">住所</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="text" name="address" value="{{ $delivery['address'] }}" />
                    </div>
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="text" name="building" value="{{ $delivery['building'] }}" />
                    </div>
                    <div class="form__error">
                        @error('building')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

        <!-- --------------- -->

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
