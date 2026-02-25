<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villas;
use App\Models\Experience;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $villa = Villas::count();
        $experience = Experience::count();
        $wedding = Product::where('type', 'wedding')->count();
        $offer = Product::where('type', 'offer')->count();

        // Blog Analytics
        $blogPosts = \App\Models\BlogPost::count();
        $blogPublished = \App\Models\BlogPost::published()->count();
        $blogDrafts = \App\Models\BlogPost::where('is_published', false)->count();
        $blogCategories = \App\Models\BlogCategory::count();

        return view('pages.cms.dashboard.index', compact(
            'villa', 'experience', 'offer', 'wedding',
            'blogPosts', 'blogPublished', 'blogDrafts', 'blogCategories'
        ));
    }
}
