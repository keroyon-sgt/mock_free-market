<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}COACHTECH Free Market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    @yield('css')

</head>

<body>
    <header class="header">
        <div class="header__inner">
            
            <div class="header-utilities">
                <div class="header__logo">
                <a href="/"><img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" /></a>
                </div>
                <form class="search-form" action="/search" method="get">
                <!-- _csrf -->
                <input class="search-form__item-input" type="text" name="keyword" value="" placeholder="なにをお探しですか?"  />
                    <!-- <button class="search-form__button" type="submit">検索</button> -->
                </form>


                <nav class="header-nav">
                    <ul>
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        @else
                        <li class="header-nav__item">
                            <button class="header-nav__button" onclick="location.href='/login'">ログイン</button>
                        </li>
                        @endif
                        <li class="header-nav__item">
                            <button class="header-nav__button" onclick="location.href='/mypage'">マイページ</button>
                        </li>
                        <li class="header-nav__sell">
                            <button class="header-nav__button-sell" onclick="location.href='/sell'">出品</button>
                        </li>
                    </ul>
                </nav>
            </div>



        </div>

    </header>

    <!-- <div class="contact__alert">
        @if(session('message'))
        <div class="contact__alert--success">
            {{ session('message') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="contact__alert--danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div> -->
    <main>
        @yield('content')
    </main>
        @yield('script')

<script>
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-form__item-input');

    // 検索入力欄からフォーカスが外れたときに検索を実行
    // searchInput.addEventListener('blur', () => {
    //     searchForm.submit();
    // });

    searchInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            searchForm.submit();
        }
        console.log('test')
    });
</script>


</body>

</html>