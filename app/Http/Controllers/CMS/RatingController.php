<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ratings|ratings-create|ratings-edit|ratings-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:ratings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ratings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ratings-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Rating::orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.rating.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function store(Request $request)
    {
        $ratingId = $request->rating_id;
        $this->validate($request, [
            'name' => 'required',
            'star_rating' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            \File::delete('img/user/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/user/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'name' => $request->name,
                'company' => $request->company,
                'comments' => $request->comments,
                'star_rating' => $request->star_rating,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension(),
            ];
        }else{
            $input = [
                'name' => $request->name,
                'company' => $request->company,
                'comments' => $request->comments,
                'star_rating' => $request->star_rating
            ];
        }

        Rating::updateOrCreate(['id' => $ratingId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $data = Rating::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Rating::where('id', $id)->first(['image']);
        \File::delete('img/user/' . $data->image);
        Rating::find($id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
