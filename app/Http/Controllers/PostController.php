<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Comment;


class PostController extends Controller
{
    
    // 顯示文章(們)
    public function index(Request $request)
    {
        $posts = cache()->rememberForever('posts-data-page:' . request('page', default:1), function(){
            return Post::with(['user'])->latest()->paginate(3);
        });

        cache()->forever('posts-data-last-page', $posts->lastPage());

        return Inertia::render('PostPage', [
            'isAuth' => Auth::check(),
            'posts' => $posts,
        ]);
    }
    
    // 發文章
    public function edit(Request $request)
    {
        Log::info('使用者:{user_id} 正要發文...', ['user_id' => auth()->user()->id]);

        $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['required','string','max:255']
        ]);

        Log::info('使用者:{user_id} 發文資料沒問題...', ['user_id' => auth()->user()->id]);

        $post = new Post([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        
        $post->save(); 

        Log::info('使用者:{user_id} 發文成功', ['user_id' => auth()->user()->id]);

        // 彈窗訊息
        $message = [
            'title' => '成功',
            'content' => '發文成功'
        ];
       
        return back()->with(['message'=>$message]);   
    }

    // 顯示單一文章和留言
    public function show(Request $request, $post_id){
        
        $post = Post::with(['user'])->where('id',$post_id)->get();
        $comments = Comment::with(['user'])->where('post_id',$post_id)
                    ->latest()->paginate(5);
        return Inertia::render('PagePostDetail', [
            'isAuth' => Auth::check(),
            'post' => $post,
            'comments' => $comments,
        ]);
    }
}
