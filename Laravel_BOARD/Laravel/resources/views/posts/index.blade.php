@extends('layouts.app')
@section('content')
  <div class='container'>

    <h2 class='page-header'>掲示板</h2>

    <!-- 検索フォーム -->
<form action="{{ route('posts.search') }}" method="GET" id="search-form" class="search-form">
  <input type="text" class="search-input" name="query" placeholder="検索キーワード">
  <button class="search-button" type="submit">検索</button>
</form>

<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

    <div id="posts-container">
      @foreach ($lists as $list)
<div class="post-box">
  <div class="post-item">
    <p class="name">{{ $list->user ? $list->user->name : '例' }}</p>
  </div>
  <div class="post-item">
    <p class="content">{{ $list->post }}</p>
  </div>
  <div class="post-item">
    <p class="time">{{ $list->created_at }}</p>
  </div>

  @if(Auth::check() && Auth::id() == $list->user_id)
    <div class="button-container">
      <a class="btn btn-primary" href="/post/{{ $list->id }}/update-form">更新</a>
      <a class="btn btn-danger" href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
    </div>
  @endif
</div>
      @endforeach
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search-form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        method: 'GET',
        data: $(this).serialize(),
        success: function(response) {
          $('#posts-container').html(response);
        }
      });
    });
  });
</script>
@endsection
