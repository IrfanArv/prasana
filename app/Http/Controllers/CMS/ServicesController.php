<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceVilla;

class ServicesController extends Controller
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
        $services = ServiceVilla::orderBy('id', 'ASC')->paginate(5);
        return view('pages.cms.villa.service', compact('services'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $serviceId = $request->service_id;
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = [
            'name' => $request->name,
        ];
        ServiceVilla::updateOrCreate(['id' => $serviceId], $input);
        return response()->json(['data' => $input]);
    }

    public function edit($id)
    {
        $service = ServiceVilla::find($id);
        return response()->json($service);
    }

    public function destroy($id)
    {
        ServiceVilla::where('id', $id)->delete();
        return response()->json(array(
            'status' => TRUE
        ));
    }
}
