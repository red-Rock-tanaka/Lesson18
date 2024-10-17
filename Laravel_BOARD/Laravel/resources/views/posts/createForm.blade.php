@extends('layouts.app')
@section('content')
    <div class='container create-form form-btn'>
        <h2 class='form-title'>新規投稿</h2>
        {!! Form::open(['url' => 'post/create']) !!}
        <div class="form-group">
            {!! Form::textarea('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        </div>

        <button type="submit" class="btn btn-success">投稿する</button>
        {!! Form::close() !!}
    </div>
@endsection
