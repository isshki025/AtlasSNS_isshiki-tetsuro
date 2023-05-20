<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="head">
            <h1><a href="/top"><img src="{{ asset('storage/images/atlas.png') }}"></a></h1>
            <div class="head_nav" id="">
                <div class="head_user" id="">
                    <p>{{ Auth::user()->username }} さん</p>
                    <button type="button" name="mene" id="toggleBtn"></button>
                    <img class="user-image" src="{{ asset('storage/images/'.Auth::user()->images) }}" alt="アイコン">
                    <div class="nav-box">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile">プロフィール編集</a></li>
                            <li>
                                <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }} さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>{{ isset($followingsCount) ? $followingsCount : 0 }}人</p>
                </div>
                <p class="btn"><a href="{{ route('followList') }}">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>{{ isset($followersCount) ? $followersCount : 0 }}人</p>
                </div>
                <p class="btn"><a href="{{ route('followerList') }}">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="{{ route('users.search') }}">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/function.js') }}"></script>
</body>

</html>
