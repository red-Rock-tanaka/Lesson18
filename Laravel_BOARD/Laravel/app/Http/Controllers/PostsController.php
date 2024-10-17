<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;



class PostsController extends Controller
{

    // public function hello()
    // {
    //   echo 'Hello World!!<br>';
    //   echo'コントローラーから';
    // }

    public function index()
{
    $list = Post::with('user')
        ->orderBy('created_at', 'desc')
        ->get();
    return view('posts.index', ['lists' => $list]);
}

    public function createForm()
    {
        return view('posts.createForm');
    }

    public function create(Request $request)
{
    $post = new Post;
    $post->post = $request->input('newPost');
    $post->user_id = auth()->id();
    $post->save();
    return redirect('/index');
}

    public function updateForm($id)
    {
        $post = DB::table('posts')
        ->where('id', $id)
        ->first();
        return view('posts.updateForm', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
        ->where('id', $id)
        ->update(
            ['post' => $up_post]
            );
        return redirect('/index');
    }

    public function delete($id)
    {
        DB::table('posts')
        ->where('id', $id)
        ->delete();
        return redirect('/index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

public function search(Request $request)
{
    $query = $request->input('query');
    $posts = Post::with('user')
        ->where('post', 'LIKE', "%{$query}%")
        ->orderBy('created_at', 'desc')
        ->get();

    $html = '';
    foreach ($posts as $post) {
        $username = $post->user ? $post->user->name : '例';
        $html .= "<div class='post-box'>
            <p>ユーザー名: {$username}</p>
            <p>投稿内容: {$post->post}</p>
            <p>投稿日時: {$post->created_at}</p>";

        if (auth()->check() && auth()->id() == $post->user_id) {
            $html .= "<a class='btn btn-primary' href='/post/{$post->id}/update-form'>更新</a>
                      <a class='btn btn-danger' href='/post/{$post->id}/delete' onclick=\"return confirm('こちらの投稿を削除してもよろしいでしょうか？')\">削除</a>";
        }

        $html .= "</div>";
    }

    return $html;
}

}
