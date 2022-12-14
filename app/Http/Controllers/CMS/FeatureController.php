<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureVilla;

class FeatureController extends Controller
{

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
        $fitur = FeatureVilla::orderBy('id', 'ASC')->paginate(5);
        return view('pages.cms.villa.fitur', compact('fitur'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $featureId = $request->feature_id;
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = [
            'name' => $request->name,
        ];
        FeatureVilla::updateOrCreate(['id' => $featureId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $feature = FeatureVilla::find($id);
        return response()->json($feature);
    }

    public function destroy($id)
    {
        FeatureVilla::where('id', $id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
