<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = Faq::orderBy('sort_order', 'ASC')->paginate(15);
        return view('pages.cms.faq.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 15);
    }

    public function store(Request $request)
    {
        $faqId = $request->faq_id;
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $input = [
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
        ];

        Faq::updateOrCreate(['id' => $faqId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $data = Faq::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Faq::find($id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
