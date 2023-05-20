@extends('layouts.login')

@section('content')
<div class="post">
  <div class="post_inner">
    <img class="user-image" src="{{ asset('storage/images/'.Auth::user()->images) }}" alt="アイコン">
    <form class="post-area" action="{{ route('posts.store') }}" method="POST">
      @csrf
      <textarea name="post" id="" cols="30" rows="5" placeholder="投稿内容を入力してください。"></textarea>
      @error('post')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <button type="submit" class="post-btn">
        <img src="images/post.png" alt="投稿">
      </button>
    </form>
  </div>

</div>

<div class="articles">
  <ul class="articles_list">
    @foreach($posts as $post)
    <li class="articles_item">
      <img class="user-image" src="{{ asset('storage/images/'.$post->user->images) }}" alt="アイコン">
      <div>
        <p class="articles_name">{{ $post->user->username }}</p>
        <div class="articles_content">
          <p>{{ $post->post }}</p>
        </div>
      </div>
      <div>
        <time>{{ $post->created_at }}</time>
        @if($post->user->id == Auth::id())
        <ul class="articles_btns">
          <li class="articles_btnItem">
            <a href="#" class="articles_btn editBtn js-modalOpen" data-post-id="{{ $post->id }}" data-post-content="{{ $post->post }}"></a>
          </li>
          <li class="articles_btnItem">
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" class="delete-form">
              @csrf
              @method('DELETE')
              <button class="articles_btn deleteBtn" type="submit"></button>
            </form>
          </li>
        </ul>
        @endif
      </div>
    </li>
    @endforeach
  </ul>
</div>
<div class="modal" id="modal">
  <div class="modal_bg"></div>
  <div class="modal_content">
    <button class="js-modalClose modal-btn" href=""></button>
    <form action="" method="POST" id="editForm">
      @csrf
      @method('PATCH')
      <textarea name="post" class="modal_post" id="editPost"></textarea>
      <input type="hidden" name="post_id" class="modal_id" value="">
      <div class="edit_btn_wrapper"><input class="edit_btn modal-btn" type="submit" value=""></div>
    </form>
  </div>
</div>

@endsection
