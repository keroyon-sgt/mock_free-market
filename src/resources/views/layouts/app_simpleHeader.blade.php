<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" />
                </a>
            </div>
        </div>
    </header>

<div class="contact__alert">
    @if(session('message'))
    <div class="contact__alert--success">
        {{ session('message') }}
    </div>
    @endif
    <!-- @if ($errors->any())
    <div class="contact__alert--danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif -->
</div>

<?php
echo '<br />session = ';
var_dump(Session::getId());

?>

    <main>
        @yield('content')
    </main>
</body>

</html>