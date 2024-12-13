<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dining;

class DiningController extends Controller
{
    private $mediaCollection = 'photo';
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:dining|dining-create|dining-edit|dining-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:dining-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dining-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dining-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $dinings = Dining::orderBy('id', 'ASC')->paginate(5);
        return view('pages.cms.dining.index', [
            'dinings' => $dinings,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('pages.cms.dining.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
        $destinationPath = 'public/img/dining/';
        $request->file('image')->move($destinationPath, $imageName);
        $input = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
            'url' => $request->url
        ];

        $dining = Dining::create($input);

        foreach ($request->input('photo', []) as $file) {
            $dining->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        return redirect()->route('dining.index')->with('success', 'Dining created successfully');
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
        $dinings = Dining::find($id);
        return view('pages.cms.dining.edit', ['dinings' => $dinings, 'photos' => $dinings->getMedia($this->mediaCollection)]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $dining = Dining::with('photos')->find($id);
        if ($request->hasFile('image')) {
            \File::delete('public/img/dining/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'public/img/dining/';
            $request->file('image')->move($destinationPath, $imageName);
            $dining->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
                'url' => $request->url
            ]);
        } else {
            $dining->update([
                'title' => $request->title,
                'description' => $request->description,
                'url' => $request->url
            ]);
        }

        if (count($dining->photos) > 0) {
            foreach ($dining->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $dining->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dining->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('dining.index')->with('success', 'Dining update successfully');
    }

    public function destroy($id)
    {
        $data = Dining::where('id', $id)->first(['image']);
        \File::delete('public/img/dining/' . $data->image);
        Dining::find($id)->delete();
        return response()->json(array(
            'status' => true
        ));
    }
}
