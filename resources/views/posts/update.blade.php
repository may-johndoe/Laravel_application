<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>投稿の編集</title>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div>
  <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
</div>
<h2>投稿の編集</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/post/{{ $post->id }}/update">
  @csrf
  タイトル<br>
  <input name="title" value="{{ $post->title }}" placeholder="タイトルを入力してく
ださい。"><br><br>

  本文<br>
  <textarea cols="50" rows="15" name="content" placeholder="本文を入力してください。
">{{ $post->content }}</textarea><br>

  <a href="/" class="btn btn-warning btn-sm">キャンセル</a>
  <input type="submit" class="btn btn-primary btn-sm" value="更新">
</form>

</body>
</html>
