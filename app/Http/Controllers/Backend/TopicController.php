<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class TopicController extends Controller
{
    protected $topic;
    public function __construct(
        \App\Model\Topic $topic
    )
    {
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = $this->topic->all();
        return view('backend/content/topic/index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->topic->where('parent_id', 0)->get();
        return view('backend/content/topic/create', compact('categories'));
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
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:topics,slug',
            'parent_id'      => 'required|max:255',
        ));

        $this->topic->create($request->all());

        Session::flash('success', 'Tạo danh mục bài viết thành công!');
        return redirect()->route('topic.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thiscat = $this->topic->findOrFail($id);
        $categories = $this->topic->where('parent_id', 0)->where('id','!=', $id)->get();
        return view('backend/content/topic/edit', compact('thiscat', 'categories'));
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
        $this->validate($request, array(
            // rules, criteria
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:topics,slug,'.$id,
            'parent_id'      => 'required|max:255',
        ));

        $this->topic->find($id)->update($request->all());

        Session::flash('success', 'The topic was successfully updated!');
        return redirect()->route('topic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return resource
     */
    public function destroy($id)
    {
        $topic = $this->topic->findOrFail($id);
        $topic->children()->delete();
        $topic->posts()->detach();
        $topic->delete();

        return redirect()->route('topic.index');
    }
}
