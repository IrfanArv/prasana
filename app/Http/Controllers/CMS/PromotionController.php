<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:promotions|promotions-create|promotions-edit|promotions-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:promotions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:promotions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:promotions-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Promotion::orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.promotion.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $promotionId = $request->promotion_id;
        $this->validate($request, [
            // 'name' => 'required',
            // 'position' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            \File::delete('img/user/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/user/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'title' => $request->title,
                'position' => $request->position,
                'urls' => $request->urls,
                'status' => $request->status,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
            ];
        }else{
            $input = [
                'title' => $request->title,
                'position' => $request->position,
                'urls' => $request->urls,
                'status' => $request->status,
            ];
        }

        Promotion::updateOrCreate(['id' => $promotionId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $data = Promotion::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Promotion::where('id', $id)->first(['image']);
        \File::delete('img/user/' . $data->image);
        Promotion::find($id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }

}
