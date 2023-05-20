@extends('layouts.login')

@section('content')

<section class="profile">
  <div class="profile_inner">
    <img class="user-image" src="{{ asset('storage/images/'.$user->images) }}" alt="アイコン1">
    <form class="profile_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="profile_items">
        <label for="username">user name</label>
        <input class="profile_inputBox" type="text" name="username" value="{{ $user->username }}">
        @error('username')
        <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="profile_items">
        <label for="mail">mail address</label>
        <input class="profile_inputBox" type="email" name="mail" value="{{ $user->mail }}">
        @error('mail')
        <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="profile_items">
        <label for="password">password</label>
        <input class="profile_inputBox" type="password" name="password">
        @error('password')
        <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="profile_items">
        <label for="password_confirmation">password confirm</label>
        <input class="profile_inputBox" type="password" name="password_confirmation">
        @error('password_confirmation')
        <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="profile_items">
        <label for="bio">bio</label>
        <input class="profile_inputBox" type="text" name="bio" value="{{ $user->bio }}">
        @error('bio')
        <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="profile_items">
        <label for="images">icon image</label>
        <div class="profile_items_inner">
          <img id="icon-preview" class="user-image" src="{{ asset('storage/images/'.$user->images) }}" alt="アイコン">
          <label class="profile_inputBox">
            <input type="file" id="icon-upload" name="images">ファイルを選択
          </label>
          @error('images')
          <span class="error">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <button class=" profile_btn" type="submit">更新</button>
    </form>
  </div>

</section>

@endsection
