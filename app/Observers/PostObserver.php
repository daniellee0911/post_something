<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    private function clearCache(){
        if(cache()->get('posts-data-last-page')===null) return;
        $user_last_page = cache()->get('posts-data-last-page');
        for($i = 1; $i <= $user_last_page; $i++){
            $key = 'posts-data-page:'. $i;
            if(cache()->has($key)){
                cache()->forget($key);
            }
        }
        cache()->forget('posts-data-last-page');
    }


    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearCache();
    }
}
