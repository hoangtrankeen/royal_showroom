<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
class PostController extends Controller
{

    protected $topic;
    protected $post;
    protected $tag;
    protected $image_handler;

    public function __construct(
        \App\Model\Topic $topic,
        \App\Model\Post $post,
        \App\Model\Tag $tag,
        \App\Http\BusinessLayer\MediaManager\ImageHandler $imageHandler
    )
    {
        $this->topic = $topic;
        $this->post = $post;
        $this->tag = $tag;
        $this->image_handler = $imageHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->all();
        return view('backend/content/post/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = $this->topic->all();
        $tags = $this->tag->all();
        return view('backend/content/post/create',compact('topics','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'          => 'required|max:190',
            'description'    => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'image'          => 'nullable|image',
            'post_content'   => 'required',
            'active'         => 'required',
            'featured'       => 'required'
        ));

       $image = $this->image_handler->saveImage(getPostImagePath(),$request->image);

       $data = array_merge($request->all(), ['image' =>$image]);
       $post = $this->post->create($data);

        $post->tags()->sync($request->tags, false);

        $post->topics()->sync($request->topics, false);

        Session::flash('success', 'Đã tạo bài viết thành công!');

        //redirect to another page
        return redirect()->route('post.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        $post_tags = $post->tags->pluck('id')->toArray();

        $post_topics = $post->topics->pluck('id')->toArray();

        $topics = $this->topic->all();
        $tags = $this->tag->all();
        return view('backend/content/post/edit', compact('post','post_tags','post_topics','tags','topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $this->post->findOrFail($id);
        $this->validate($request, array(
            // rules, criteria
            'title'          => 'required|max:190',
            'description'    => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:posts,slug,'.$id,
            'image'          => 'nullable|image',
            'post_content'   => 'required',
            'active'         => 'required',
            'featured'       => 'required'
        ));

        $image = $this->image_handler->updateImage(getPostImagePath(), $request->image, $post->image);
            
        $data = array_merge($request->all(), ['image' =>$image]);
        $post->update($data);

        $post->tags()->sync($request->tags);
        $post->topics()->sync($request->topics);

        Session::flash('success', 'Bài viết đã được cập nhật!');

        //redirect to another page
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);

        $post->topics()->detach();

        $this->image_handler->deleteImage(getPostImagePath(), $post->image);

        $post->delete();

        Session::flash('success', 'Bài viết đã được xóa!');

        return redirect()->route('post.index');
    }
}
