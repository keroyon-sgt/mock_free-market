@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')

<div class="register-form__content">
    <div class="register-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">@csrf
        <div class="form__group">
            <div class="form__group-profile">
                <img src="{{ asset('storage/' . $user->portrait_path) }}" alt="{{ $user->name }}">
            </div>
            <div class="form__group-content">
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
                <span class="form__label--item">ユーザー名 </span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="name" value="{{ $user['name'] }}" placeholder="例：山田&nbsp太郎" />
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
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="postal_code" value="{{ $user['postal_code'] }}" placeholder="例：123-4567" />
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
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ $user['address'] }}" />
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
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例：千駄ヶ谷マンション" value="{{ $user['building'] }}" />
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
