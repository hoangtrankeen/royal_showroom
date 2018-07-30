<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Category;
use App\Model\Post;
use App\Model\Topic;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data['posts'] = Post::orderBy('created_at', 'desc')->paginate(6);
        $data['topics'] = Topic::take(6)->get();
        if($request->session()->has('topic')){
            $request->session()->forget('topic');
        }

        return view('frontend/blog/list-post', $data);
    }

    public function details(Request $request, $slug)
    {
        $data['post'] = Post::where('slug', $slug)->first();

        return view('frontend/blog/post-detail',$data);
    }

    public function topic(Request $request,$slug)
    {
        $topic = Topic::where('slug', $slug)->first();

        $posts = $topic->posts()->paginate(3);

        $data['posts'] = $posts;

        $request->session()->put('topic', [
            'name' => $topic->name,
            'slug' => $topic->slug
        ]);

        return view('frontend/blog/list-post',$data);
    }

    public function getSalePost()
    {
        $topic = Topic::where('type_id','sale')->first();

        $data['posts'] = $topic->posts()->paginate(4);

        return view('frontend/blog/list-post',$data);

    }


}
