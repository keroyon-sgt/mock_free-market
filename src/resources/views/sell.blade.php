@php
    $title = '商品の出品　';
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="form__content">
    <div class="form__heading">
        <h2>商品の出品</h2>
    </div>
    <form class="form" action="/sell" method="post" enctype="multipart/form-data">@csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">商品画像 </span>
            </div>

            <div class="form__group-content">
                <div class="form__file-place">
                    <input class="form__file" type="file" name="image" accept="image/png, image/jpeg" />
                    <!-- <input class="form__file-cover" type="button" /> -->
                </div>
                <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>
        <h3>商品の詳細</h3>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">カテゴリー</span>
            </div>
            <div class="form__group-content">
                <div class="form__checkbox-category">

@foreach ($categories as $category)
                        <label><input type="checkbox" name="category[]" value="{{$category['id']}}"><span>{{$category['content']}}</span></label>
@endforeach

                    </div>
                <div class="form__error">
                @error('category')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">商品の状態</span>
                <!-- <span class="form__label--required">※</span> -->
            </div>
            <div class="form__group-content">
                <div class="form__select-condition">
                    <!-- <input type="text" name="category" placeholder="test@example.com" value="{{ old('category_id') }}" /> -->
                    <select class="form__item-select" name="condition">
                        <option value="0" disabled selected>選択してください</option>
                        <option value="a">良好</option>
                        <option value="b">目立った傷や汚れなし</option>
                        <option value="c">やや傷や汚れあり</option>
                        <option value="d">状態が悪い</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('condition')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>



        <h3>商品名と説明</h3>


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">商品名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="title" value="{{ old('postal_code') }}" />
                </div>
                <div class="form__error">
                    @error('title')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- --------------- -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">ブランド</span>
                    <!-- <span class="form__label--required">※</span> -->
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="text" name="brand" value="{{ old('address') }}" />
                    </div>
                    <div class="form__error">
                        @error('brand')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">商品の説明</span>
                    <!-- <span class="form__label--required">※</span> -->
                </div>
                <div class="form__group-content">
                    <div class="form__input-textarea">
                        <textarea name="description" >{{ old('description') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>





            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label-item">販売価格</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-price">
                        <input type="text" name="price" value="{{ old('building') }}" />
                    </div>
                    <div class="form__error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

        <!-- --------------- -->

        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
    
</div>
@endsection
