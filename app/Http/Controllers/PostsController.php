<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // モデルクラスPost
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
	    $this->middleware('auth');
    }


    public function list()
    {
	// DBから10件ずつ最新の記事から抽出
	$posts = Post::orderBy('created_at', 'desc')->paginate(10);

	return view('posts.list', [
	    'user' => Auth::user(),
	    'id' => Auth::id(),
	    'posts' => $posts
	]);
    }

    // 新規登録フォーム表示
    public function insert()
    {
	return view('posts.insert');
    }

    // フォームに入力されたデータをDBに登録
    public function do_insert(Request $request)
    {
        $validatedDate = $request->validate( [
            'title' => ['required' , 'string' , 'max:20'],
            'content' => ['required', 'string' , 'between:10,140']
        ]);
	// authorとcommentsフィールドを追加してDBに登録
	$user = Auth::user();
	
	$request->merge([
            'author' => $user->name,
            'comments' => 0,
        ]);
        Post::create($request->all());

	return redirect('/');
    }

    // $id で指定した投稿の詳細表示
    public function show($id)
    {
	// $id の記事のみをDB から取得
	$post = Post::find($id);
	
	$comment = DB::table('comments')->where('post_id','=',$id)->get();

	// ビュー(posts\show.blade.php)に結果を渡す
	return view('posts.show', [
		'post' => $post,
		'comments' => $comment
	]);
    }

    // $id で指定した投稿の編集フォーム表示
    public function update($id)
    {
	// $id の記事のみをDB から取得
	$post = Post::find($id);

	// ビュー(posts\update.blade.php)に結果を渡す
	return view('posts.update', [
	    'post' => $post,
	]);
    }
	
    // $id で指定した投稿の編集結果をDB に反映
    public function do_update($id, Request $request)
    {
        $validatedDate = $request->validate( [
            'title' => ['required' , 'string' , 'max:20'],
            'content' => ['required', 'string' , 'between:10,140']
    	]);
	//更新するデータのみをセットしてDB更新
	$update = [
		'title' => $request->title,
		'content' => $request->content,	
	];
	Post::where('id',$id)->update($update);

	return redirect('/');
    }

    // $id で指定した投稿の削除
    public function drop($id)
    {
	Post::where('id', $id)->delete();
	return redirect('/');
    }

    public function comment_page($id, Request $request)
    {
	        return view('posts.comment', [
            'id' => $id,
        ]);
    }

    // $idで指定したコメントの投稿
    public function comment($id, Request $request)
    {
	$user = Auth::user();

	$param = [
		 'author' => $user->name,
		 'comment_content' => ($request->content),
		 'post_id'=>$id,
		 'created_at' => Carbon::now()
	];
	DB::table('comments')->insert($param);

    // $id の記事のみをDB から取得
        $post = Post::find($id);

        $comment = DB::table('comments')->where('post_id','=',$id)->get();

        // ビュー(posts\show.blade.php)に結果を渡す
        return view('posts.show', [
                'post' => $post,
                'comments' => $comment
        ]);}

}
