@extends('layouts.login')

@section('content')
<div class="follows-btns">
  <h2 class="follows-btns_ttl">Follower List</h2>
  <ul class="follows-btns_list">
    @foreach ($followers as $follower)
    @if ($follower->id !== Auth::user()->id)
    <li class="col-md-4">
      <a href="{{ url('/profile/' . $follower->id) }}">
        <img class="user-image" src="{{ asset('storage/images/'.$follower->images) }}" alt="アイコン">
      </a>
    </li>
    @endif
    @endforeach
  </ul>
</div>
<div class="follows-lists">
  <ul class="follows-list">
    @foreach ($posts as $post)
    <li class="follows-item">
      <a class="follows-link" href="{{ url('/profile/' . $post->user->id) }}">
        <img class="user-image" src="{{ asset('storage/images/'.$post->user->images) }}" alt="アイコン">
      </a>
      <div class="follows-post_wrapper">
        <div class="follows-post_head">
          <p class="follows-post_name">{{ $post->user->username }}</p>
          <time class="follows-post_time">{{ $post->created_at->format('Y/m/d H:i') }}</time>
        </div>
        <p class="follows-post_content">{{ $post->post }}</p>
      </div>
    </li>
    @endforeach
  </ul>
</div>
@endsection
