@extends('layouts.login')

@section('content')
<div class="otherProfile">
  <div class="otherProfile_info">
    <img class="user-image" src="{{ asset('storage/images/'.$user->images) }}" alt="アイコン">
    <div class="otherProfile_data">
      <dl>
        <div class="otherProfile_item">
          <dt>name</dt>
          <dd>{{ $user->username }}</dd>
        </div>
        <div class="otherProfile_item">
          <dt>bio</dt>
          <dd>{{ $user->bio }}</dd>
        </div>
      </dl>
    </div>
    @if (Auth::user()->following->contains($user->id))
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
  </div>

  <div class="follows_lists">
    <ul class="follows_list">
      @foreach($posts as $post)
      <li class="follows-item">
        <img class="user-image" src="{{ asset('storage/images/'.$user->images) }}" alt="アイコン">
        <div class="follows-post_wrapper">
          <div class="follows-post_head">
            <p class="follows-post_name">{{ $user->username }}</p>
            <time class="follows-post_time">{{ $post->created_at->format('Y-m-d H:i') }}</time>
          </div>
          <p class="follows-post_content">{{ $post->post }}</p>
        </div>
      </li>
      @endforeach
    </ul>
  </div>

</div>
@endsection




<!--

<div class="posts_lists">
  <ul class="posts_list">
    @foreach($posts as $post)
    <li class="posts_item">
      <img class="user-image" src="{{ asset('storage/images/'.$user->images) }}" alt="アイコン">
      <div class="posts-content_wrapper">
        <p class="posts-content_name">{{ $user->username }}</p>
        <time class="posts-content_time">{{ $post->created_at->format('Y-m-d H:i') }}</time>
      </div>
      <p class="posts-content_txt">{{ $post->post }}</p>
    </li>
    @endforeach
  </ul>
</div> -->
