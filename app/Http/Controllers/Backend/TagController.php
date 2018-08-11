<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    protected $tag;
    public function __construct(
        \App\Model\Tag $tag
    )
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->all();
        return view('backend/content/tag/index', compact('tags'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend/content/tag/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'=> 'required|string|max:100'
        ));

        $this->validate($request, array('name' => 'required|max:100'));
        $this->tag->create($request->all());
        Session::flash('success', 'Đã tạo tag thành công!');
        return  redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tag->find($id);

        return view('backend/content/tag/edit', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name'=> 'required|string|max:100'
        ));

        $this->tag->findOrfail($id)->update($request->all());

        Session::flash('success', 'Đã cập nhật tag thành công');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = $this->tag->find($id);
        $tag->posts()->detach();
        $tag->delete();

        Session::flash('success', 'Tag đã được xóa');

        return redirect()->route('tag.index');
    }
}
