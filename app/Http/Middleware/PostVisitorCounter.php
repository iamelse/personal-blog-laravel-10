<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\PostView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostVisitorCounter
{
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');
        $today = now()->toDateString();

        if ($slug) {
            $post = Post::where('slug', $slug)->first();

            if ($post) {
                $postView = PostView::where('post_id', $post->id)
                    ->where('view_date', $today)
                    ->first();

                if ($postView) {
                    $postView->increment('view_count');
                } else {
                    PostView::create([
                        'post_id' => $post->id,
                        'view_date' => $today,
                        'view_count' => 1,
                    ]);
                }
            }
        }

        return $next($request);
    }
}