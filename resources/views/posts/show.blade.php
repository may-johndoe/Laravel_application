<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>投稿の詳細</title>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div>
  <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
</div
>
<h1>{{ $post->title }}</h1>
<p>{!! nl2br(e($post->content)) !!}</p>
<a href="/" class="btn btn-warning btn-xs">戻る</a>
<a href="/post/{{ $post->id }}/comment" class="btn btn-success btn-xs">コメント追加</a>

<h4>コメント</h4>
@if($errors->any())
<div class="error">
 <ul>
 @foreach($errors->all() as $message)
 <li>{{ message }}</li>
 @endforeach
 </ul>
</div>
@endif
@isset($comments)
@foreach($comments as $comment)
<p>User: {{ $comment->author }} Time:{{$comment->created_at }}</p>
<p> {{ $comment->comment_content }}</p>
@endforeach
@endisset

</body>
</html>
