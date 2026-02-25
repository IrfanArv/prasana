<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class BlogController extends Controller
{
    private $mediaCollection = 'photo';

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $posts = BlogPost::with(['author', 'categories', 'tags'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('pages.cms.blog.index', [
            'posts' => $posts,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('pages.cms.blog.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:blog_posts,slug',
            'content' => 'required',
        ]);

        if ($request->hasFile('cover_image')) {
            $imageName = date('YmdHis') . "." . $request->cover_image->getClientOriginalExtension();
            $destinationPath = public_path('img/blog/');
            $request->file('cover_image')->move($destinationPath, $imageName);
            $coverImage = $imageName;
        } else {
            $coverImage = null;
        }

        $post = BlogPost::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'cover_image' => $coverImage,
            'author_id' => auth()->id(),
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_published' => $request->has('is_published') ? true : false,
            'published_at' => $request->published_at,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
        ]);

        // Attach categories
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        // Attach tags
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        // Handle media gallery
        foreach ($request->input('photo', []) as $file) {
            $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        return redirect()->route('blog.index')->with('success', 'Blog post created successfully');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function edit($id)
    {
        $post = BlogPost::with(['categories', 'tags'])->find($id);
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        $photos = $post->getMedia($this->mediaCollection);

        return view('pages.cms.blog.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'photos' => $photos,
            'selectedCategories' => $post->categories->pluck('id')->toArray(),
            'selectedTags' => $post->tags->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:blog_posts,slug,' . $id,
            'content' => 'required',
        ]);

        $post = BlogPost::with('photos')->find($id);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_published' => $request->has('is_published') ? true : false,
            'published_at' => $request->published_at,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
        ];

        if ($request->hasFile('cover_image')) {
            \File::delete(public_path('img/blog/' . $post->cover_image));
            $imageName = date('YmdHis') . "." . $request->cover_image->getClientOriginalExtension();
            $destinationPath = public_path('img/blog/');
            $request->file('cover_image')->move($destinationPath, $imageName);
            $data['cover_image'] = $imageName;
        }

        $post->update($data);

        // Sync categories and tags
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        // Handle media
        if (count($post->photos) > 0) {
            foreach ($post->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $post->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully');
    }

    public function destroy($id)
    {
        $post = BlogPost::where('id', $id)->first(['cover_image']);
        if ($post->cover_image) {
            \File::delete(public_path('img/blog/' . $post->cover_image));
        }
        BlogPost::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
