@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="register-form__content">
    <div class="register-form__heading">
        <h2>商品の出品</h2>
    </div>
    <form class="form" action="/register" method="post">@csrf
        <h3>商品の詳細</h3>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像 </span>
            </div>


            <div class="form__group-content form__image-place">
                <div class="form__input--image">
                <input type="file" name="portrait" accept="image/png, image/jpeg" />
                </div>
                <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">カテゴリー</span>
            </div>
            <div class="form__group-content">
                <div class="form__checkbox-category">

@foreach ($categories as $category)
                        <label><input type="checkbox" name="category" value="{{$category['id']}}">{{$category['content']}}</label>
@endforeach

                    </div>
                <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品の状態</span>
                <!-- <span class="form__label--required">※</span> -->
            </div>
            <div class="form__group-content">
                <div class="form__select-category">
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
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>



        <h3>商品名と説明</h3>


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="title" value="{{ old('postal_code') }}" placeholder="例：123-4567" />
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
                    <span class="form__label--item">ブランド</span>
                    <!-- <span class="form__label--required">※</span> -->
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="brand" value="{{ old('address') }}" />
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
                    <span class="form__label--item">商品の説明</span>
                    <!-- <span class="form__label--required">※</span> -->
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" >{{ old('detail') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>





            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">価格</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="price" placeholder="&#165;" value="{{ old('building') }}" />
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
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
    
</div>
@endsection
