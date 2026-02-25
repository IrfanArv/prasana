<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;

class BlogTagController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = BlogTag::withCount('posts')->orderBy('name')->get();

        return view('pages.cms.blog-tag.index', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:blog_tags,slug,' . $request->id,
        ]);

        BlogTag::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'slug' => $request->slug,
            ]
        );

        $message = $request->id ? 'Tag updated successfully' : 'Tag created successfully';
        return redirect()->route('blog-tag.index')->with('success', $message);
    }

    public function edit($id)
    {
        $tag = BlogTag::find($id);
        $tags = BlogTag::withCount('posts')->orderBy('name')->get();

        return view('pages.cms.blog-tag.index', [
            'tags' => $tags,
            'editTag' => $tag
        ]);
    }

    public function destroy($id)
    {
        BlogTag::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
