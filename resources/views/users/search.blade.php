@extends('layouts.login')

@section('content')

<section class="search-area">
  <form class="search-form" action="{{ route('users.search') }}" method="GET">
    <input class="search-form_area" type="search" name="keyword" placeholder="ユーザー名で検索">
    <input class="search-form_btn" type="submit" name="submit" value="">
  </form>
  @if(request()->input('keyword') != "")
  <p>検索ワード: {{ request()->input('keyword') }}</p>
  @endif
</section>
<section class="searched-lists">
  <ul class="search-list">
    @foreach ($users as $user)
    <li class="search-item">
      <img class="user-image" src="storage/images/{{ $user->images }}" alt="アイコン">
      <p class="follow-btn">{{ $user->username }}</p>
      @if (Auth::user()->followings->contains($user->id))
      <form class="follows-btn" action="{{ route('users.unfollow', $user) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="remove-btn" type="submit">フォロー解除</button>
      </form>
      @else
      <form class="follows-btn" action="{{ route('users.follow', $user) }}" method="post">
        @csrf
        <button type="submit">フォローする</button>
      </form>
      @endif
    </li>
    @endforeach
  </ul>
</section>

@endsection
