<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villas;
use App\Models\FeatureVilla;
use App\Models\ServiceVilla;

class VillasController extends Controller
{
    private $mediaCollection = 'photo';

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:villa-list|villa-create|villa-edit|villa-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:villa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:villa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:villa-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $villas = Villas::orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.villa.index', [
            'villas' => $villas,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $featureVilla = FeatureVilla::get();
        $serviceVilla = ServiceVilla::get();
        return view('pages.cms.villa.create', compact('featureVilla', 'serviceVilla'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'slug' => 'required',
            'building_area' => 'required',
            'description' => 'required',
            'capacity' => 'required',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'meta_keyword' => 'required',
            'featured' => 'required',
            'services' => 'required',
        ]);
        $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
        $destinationPath = 'img/villas/';
        $request->file('image')->move($destinationPath, $imageName);
        $input = [
            'name' => $request->name,
            'building_area' => $request->building_area,
            'capacity' => $request->capacity,
            'slug' => $request->slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
            'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
            'featured' => implode(',', (array)$request->input('featured')),
            'services' => implode(',', (array)$request->input('services')),
        ];
        $villa = Villas::create(
            $input
        );
        foreach ($request->input('photo', []) as $file) {
            $villa->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        return redirect()->route('villa.index')->with('success', 'Villa created successfully');
    }

    public function edit($id)
    {
        $villa = Villas::find($id);
        $featureVilla = FeatureVilla::get();
        $serviceVilla = ServiceVilla::get();
        $featureActive = explode(',', $villa->featured);
        $serviceActive = explode(',', $villa->services);
        return view('pages.cms.villa.edit',
        [
            'villa' => $villa,
            'serviceActive' => $serviceActive,
            'featureVilla' => $featureVilla,
            'serviceVilla' => $serviceVilla,
            'featureActive' => $featureActive,
            'photos' => $villa->getMedia($this->mediaCollection)

        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'building_area' => 'required',
            'description' => 'required',
            'capacity' => 'required',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'meta_keyword' => 'required',
            'featured' => 'required',
            'services' => 'required',
        ]);

        $villa = Villas::with('photos')->find($id);
        if ($request->hasFile('image')) {
            \File::delete('img/villas/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/villas/';
            $request->file('image')->move($destinationPath, $imageName);
            $villa->update([
                'name' => $request->name,
                'building_area' => $request->building_area,
                'capacity' => $request->capacity,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
                'featured' => implode(',', (array)$request->input('featured')),
                'services' => implode(',', (array)$request->input('services')),
            ]);
        } else {
            $villa->update([
                'name' => $request->name,
                'building_area' => $request->building_area,
                'capacity' => $request->capacity,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
                'featured' => implode(',', (array)$request->input('featured')),
                'services' => implode(',', (array)$request->input('services')),
            ]);
        }

        if (count($villa->photos) > 0) {
            foreach ($villa->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $villa->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $villa->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('villa.index')->with('success', 'Villa update successfully');
    }

    public function destroy($id)
    {
        $data = Villas::where('id', $id)->first(['image']);
        \File::delete('img/villas/' . $data->image);
        Villas::find($id)->delete();
        return response()->json(array(
            'status' => true
        ));
    }

}
