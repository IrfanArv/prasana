<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    private $mediaCollection = 'photo';
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:experience|experience-create|experience-edit|experience-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:experience-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:experience-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:experience-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $experiences = Experience::orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.experience.index', [
            'experiences' => $experiences,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('pages.cms.experience.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'location' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/experience/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'title' => $request->title,
                'location' => $request->location,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension()
            ];
        } else {
            $input = [
                'title' => $request->title,
                'location' => $request->location,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword
            ];
        }
        $experience = Experience::create($input);

        foreach ($request->input('photo', []) as $file) {
            $experience->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        return redirect()->route('experience.index')->with('success', 'Experience created successfully');
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
        $experiences = Experience::find($id);
        return view('pages.cms.experience.edit', ['experiences' => $experiences, 'photos' => $experiences->getMedia($this->mediaCollection)]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'location' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        $experience = Experience::with('photos')->find($id);
        if ($request->hasFile('image')) {
            \File::delete('img/experience/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/experience/';
            $request->file('image')->move($destinationPath, $imageName);
            $experience->update([
                'title' => $request->title,
                'location' => $request->location,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension()
            ]);
        } else {
            $experience->update([
                'title' => $request->title,
                'location' => $request->location,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword
            ]);
        }

        if (count($experience->photos) > 0) {
            foreach ($experience->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $experience->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $experience->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('experience.index')->with('success', 'experience update successfully');
    }

    public function destroy($id)
    {
        $data = Experience::where('id', $id)->first(['image']);
        \File::delete('img/experience/' . $data->image);
        Experience::find($id)->delete();
        return response()->json(array(
            'status' => true
        ));
    }
}
