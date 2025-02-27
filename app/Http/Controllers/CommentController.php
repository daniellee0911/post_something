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
use App\Jobs\SendEmailJob;

class CommentController extends Controller
{
     // 留下留言
     public function edit(Request $request, $post_id)
     {
        Log::info('使用者:{user_id} 在貼文:{post_id} 正要留言...', ['user_id' => auth()->user()->id,'post_id'=> intval($post_id)]);


        $request->validate([
            'message' => ['required','string','max:255'],
        ]);

        Log::info('使用者:{user_id} 在貼文:{post_id} 留言資料沒問題...', ['user_id' => auth()->user()->id,'post_id'=> intval($post_id)]);

        $comment = new Comment([
            'post_id' => $post_id,
            'user_id' => auth()->user()->id,
            'message' => $request->input('message'),
        ]);
        
        $comment->save(); 

        Log::info('使用者:{user_id} 在貼文:{post_id} 留言成功', ['user_id' => auth()->user()->id,'post_id'=> intval($post_id)]);

        $post = Post::with(['user'])->where('id', $post_id)->first();

        $otherCommentsCount = Comment::where('post_id', $post_id)
        ->where('user_id','<>',$post->user_id)->count();
        
        $mailData = [
            'title' => '有文章有不少留言',
            'message' => '你在 '.$post->created_at. ' 發文名為 '.$post->title  . ' 的文章有不少留言!!',
        ];

        // 如果其他人(們)留下三則就發信
        if($post->user->email_verified_at && $otherCommentsCount===3){
            SendEmailJob::dispatch($post->user->email,$mailData);
        }


        // 彈窗訊息
        $message = [
            'title' => '成功',
            'content' => '留言成功'
        ];
       
        return back()->with(['message'=>$message]);   
    }
}
