<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageSlider;

class PageSliderController extends Controller
{
    private $mediaCollection = 'photo';

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:page-slider|page-slider-create|page-slider-edit|page-slider-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:page-slider-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-slider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-slider-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sliders = PageSlider::all();
        return view('pages.cms.sliders.index', [
            'sliders' => $sliders,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function create()
    {
        return view('pages.cms.sliders.create');
    }

    public function store(Request $request)
    {
        $sliders = PageSlider::create([
            'pages' => $request->pages,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);
        foreach ($request->input('photo', []) as $file) {
            $sliders->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        return redirect()->route('sliders.index')->with('success', 'Sliders created successfully');
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
        $sliders = PageSlider::find($id);
        return view('pages.cms.sliders.edit', ['sliders' => $sliders, 'photos' => $sliders->getMedia($this->mediaCollection)]);
    }
    public function update(Request $request, $id)
    {
        $slider = PageSlider::with('photos')->find($id);
        $slider->update([
            'pages' => $request->pages,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        if (count($slider->photos) > 0) {
            foreach ($slider->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $slider->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $slider->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('sliders.index')->with('success', 'Sliders update successfully');
    }

    public function destroy($id)
    {
        PageSlider::find($id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
