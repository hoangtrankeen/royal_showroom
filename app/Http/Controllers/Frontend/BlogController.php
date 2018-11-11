<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{      

    protected $post;
    protected $category;

    public function __construct(
        \App\Model\Post $post,
        \App\Model\Topic $category
    ) {
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $posts = $this->post->orderBy('created_at', 'desc')->paginate(6);
        $topics = $this->topic->take(6)->get();
        if($request->session()->has('topic')){
            $request->session()->forget('topic');
        }

        return view('frontend/content/blog/list-post', compact('posts', 'topics'));
    }

    public function details(Request $request, $slug)
    {
        $post = $this->post->where('slug', $slug)->first();

        return view('frontend/content/blog/post-detail',compact('post'));
    }

    public function topic(Request $request,$slug)
    {
        $topic = $this->topic->where('slug', $slug)->first();

        $posts = $topic->posts()->paginate(3);

        $request->session()->put('topic', [
            'name' => $topic->name,
            'slug' => $topic->slug
        ]);

        return view('frontend/blog/list-post',compact('posts'));
    }
}
