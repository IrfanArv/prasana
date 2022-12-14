<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;


class SettingController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = Setting::findOrFail(1);
        return view('pages.cms.settings.index', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'gplus' => 'required',
            'maps' => 'required',
            'wa_number' => 'required',
            'wa_message' => 'required',
            'widget_book' => 'required',
        ]);

        $input = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'gplus' => $request->gplus,
            'maps' => $request->maps,
            'wa_number' => $request->wa_number,
            'wa_message' => $request->wa_message,
            'widget_book' => $request->widget_book,
        ];
        $settings = Setting::find($id);
        $settings->update($input);
        return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
    }
}
