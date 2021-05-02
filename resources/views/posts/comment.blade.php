<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>コメント投稿</title>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div>
  <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
</div>
<h2>コメント投稿</h2>

@if($errors->any())
    <div class="error">
      <ul>
        @foreach($errors->all() as $message)
          <li>{{ message }}</li>
        @endforeach
      </ul>
    </div>
@endif

<form method="POST" action="/post/{{$id}}/comment">
  @csrf
  コメント内容<br>
  <textarea cols="50" rows="15" name="content" placeholder="コメントを入力してください。
"></textarea><br>

  <a href="/" class="btn btn-warning btn-sm">キャンセル</a>
  <input type="submit" class="btn btn-primary btn-sm" value="投稿">
</form>

</body>
</html>
