<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyDetail;

class PropertyDetailController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = PropertyDetail::orderBy('sort_order', 'ASC')->paginate(15);
        return view('pages.cms.property-detail.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 15);
    }

    public function store(Request $request)
    {
        $detailId = $request->detail_id;
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $input = [
            'title' => $request->title,
            'content' => $request->content,
            'sort_order' => $request->sort_order ?? 0,
        ];

        PropertyDetail::updateOrCreate(['id' => $detailId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $data = PropertyDetail::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        PropertyDetail::find($id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
