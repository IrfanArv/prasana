<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallerie;

class GallerieController extends Controller
{
    private $mediaCollection = 'photo';
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:gallery|gallery-create|gallery-edit|gallery-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:gallery-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $gallerys = Gallerie::all();
        return view('pages.cms.gallery.index', [
            'gallerys' => $gallerys,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function create()
    {
        return view('pages.cms.gallery.create');
    }

    public function store(Request $request)
    {
        $gallery = Gallerie::create([
            'title' => $request->title,
        ]);
        foreach ($request->input('photo', []) as $file) {
            $gallery->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        return redirect()->route('gallery.index')->with('success', 'Gallery created successfully');
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
        $gallerys = Gallerie::find($id);
        return view('pages.cms.gallery.edit', ['gallerys' => $gallerys, 'photos' => $gallerys->getMedia($this->mediaCollection)]);
    }
    public function update(Request $request, $id)
    {
        $gallery = Gallerie::with('photos')->find($id);
        $gallery->update([
            'title' => $request->title,
        ]);

        if (count($gallery->photos) > 0) {
            foreach ($gallery->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $gallery->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $gallery->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('gallery.index')->with('success', 'Gallery update successfully');
    }

    public function destroy($id)
    {
        Gallerie::find($id)->delete();
        return response()->json(array(
            'status' => true
        ));
    }
}
