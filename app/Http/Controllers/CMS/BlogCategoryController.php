<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        return view('pages.cms.blog-category.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,' . $request->id,
        ]);

        BlogCategory::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
            ]
        );

        $message = $request->id ? 'Category updated successfully' : 'Category created successfully';
        return redirect()->route('blog-category.index')->with('success', $message);
    }

    public function edit($id)
    {
        $category = BlogCategory::find($id);
        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        return view('pages.cms.blog-category.index', [
            'categories' => $categories,
            'editCategory' => $category
        ]);
    }

    public function destroy($id)
    {
        BlogCategory::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
