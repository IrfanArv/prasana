<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Nette\Utils\Image;

class ProductController extends Controller
{
    private $mediaCollection = 'photo';

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:wedding-offers|wedding-offers-create|wedding-offers-edit|wedding-offers-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:wedding-offers-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:wedding-offers-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:wedding-offers-delete', ['only' => ['destroy']]);
    }

    public function weddingList(Request $request)
    {
        $data = Product::where('type', 'wedding')->orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.products.weddings.index', [
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function offersList(Request $request)
    {
        $data = Product::where('type', 'offer')->orderBy('id', 'DESC')->paginate(5);
        return view('pages.cms.products.offers.index', [
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function createOffer()
    {
        return view('pages.cms.products.offers.create');
    }

    public function createWedding()
    {
        return view('pages.cms.products.weddings.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/products/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'title' => $request->title,
                'type' => $request->type,
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
                'type' => $request->type,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
            ];
        }
        $products = Product::create($input);

        foreach ($request->input('photo', []) as $file) {
            $products->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }
        if ($request->type === 'wedding') {
            return redirect()->route('wedding.index')->with('success', 'Wedding Package created successfully');
        } else {
            return redirect()->route('offers.index')->with('success', 'Offers Package created successfully');
        }
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

    public function editWedding($id)
    {
        $data = Product::find($id);
        return view('pages.cms.products.weddings.edit', ['data' => $data, 'photos' => $data->getMedia($this->mediaCollection)]);
    }

    public function editOffer($id)
    {
        $data = Product::find($id);
        return view('pages.cms.products.offers.edit', ['data' => $data, 'photos' => $data->getMedia($this->mediaCollection)]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);
        $product = Product::with('photos')->find($id);
        if ($request->hasFile('image')) {
            \File::delete('img/products/' . $request->hidden_image);
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/products/';
            $request->file('image')->move($destinationPath, $imageName);
            $product->update([
                'title' => $request->title,
                'type' => $request->type,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension()
            ]);
        } else {
            $product->update([
                'title' => $request->title,
                'type' => $request->type,
                'slug' => $request->slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_desc' => $request->meta_desc,
                'meta_keyword' => $request->meta_keyword,
            ]);
        }

        if (count($product->photos) > 0) {
            foreach ($product->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        if ($request->type === 'wedding') {
            return redirect()->route('wedding.index')->with('success', 'Wedding Package created successfully');
        } else {
            return redirect()->route('offers.index')->with('success', 'Offers Package created successfully');
        }
    }

    public function destroy($id)
    {
        $data = Product::where('id', $id)->first(['image']);
        \File::delete('img/products/' . $data->image);
        Product::find($id)->delete();
        return response()->json(array(
            'status' => true
        ));
    }
}
