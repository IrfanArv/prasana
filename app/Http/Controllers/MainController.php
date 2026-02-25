<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSlider;
use App\Models\Villas;
use App\Models\Rating;
use App\Models\Gallerie;
use App\Models\FeatureVilla;
use App\Models\ServiceVilla;
use App\Models\Product;
use App\Models\Experience;
use App\Models\Dining;
use Mail;
use App\Mail\NotifyMail;
use App\Models\Promotion;
use App\Models\Setting;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class MainController extends Controller
{
    private $mediaCollection = 'photo';

    public function getBanner()
    {
        $promosi = Promotion::where('status', 'active')->first();
        return response()->json(['data' => $promosi]);
    }

    // HOME
    public function index()
    {
        $mainSlider = PageSlider::where('pages', 'home')->first();
        $homeSlider = PageSlider::where('pages', 'home2')->first();
        $villas = Villas::orderBy('id', 'DESC')->get();
        $ratings = Rating::orderBy('id', 'DESC')->get();
        $gallery = Gallerie::orderBy('id', 'asc')->get();
        $slide = Gallerie::first();
        return view('pages.main.home.index', [
            'mainSlider'        => $mainSlider,
            'slide' => $slide,
            'homeSlider'        => $homeSlider,
            'villas'            => $villas,
            'ratings'           => $ratings,
            'gallery'           => $gallery,
            'mediaCollection'   => $this->mediaCollection
        ]);

    }

    // VILLA
    public function listVilla()
    {
        $data = Villas::orderBy('id', 'asc')->get();
        $mainSlider = PageSlider::where('pages', 'villa')->first();
        return view('pages.main.villas.index', [
            'data' => $data,
            'mainSlider' => $mainSlider,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function detailVilla($slug)
    {
        $data = Villas::where('slug', $slug)->first();
        $featureVilla = FeatureVilla::get();
        $serviceVilla = ServiceVilla::get();
        $featureActive = explode(',', $data->featured);
        $serviceActive = explode(',', $data->services);
        return view('pages.main.villas.details', [
            'data' => $data,
            'serviceActive' => $serviceActive,
            'featureVilla' => $featureVilla,
            'serviceVilla' => $serviceVilla,
            'featureActive' => $featureActive,
            'mediaCollection' => $this->mediaCollection
        ]);
    }
    // END VILLA
    public function dining()
    {
        $mainSlider = PageSlider::where('pages', 'dining')->first();
        $whim = PageSlider::where('pages', 'whim')->first();
        $data = Dining::orderBy('id', 'ASC')->get();
        return view('pages.main.dining.index', [
            'whim' => $whim,
            'data'  => $data,
            'mainSlider' => $mainSlider,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function spa()
    {
        $mainSlider = PageSlider::where('pages', 'spa')->first();
        $sliderSpa = PageSlider::where('pages', 'spa2')->first();
        return view('pages.main.spa.index', [
            'mainSlider' => $mainSlider,
            'sliderSpa' => $sliderSpa,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function wedding()
    {
        $mainSlider = PageSlider::where('pages', 'wedding')->first();
        $data = Product::where('type', 'wedding')->orderBy('id', 'DESC')->get();
        return view('pages.main.wedding.index', [
            'mainSlider' => $mainSlider,
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function offers()
    {
        $mainSlider = PageSlider::where('pages', 'offers')->first();
        $data = Product::where('type', 'offer')->orderBy('id', 'DESC')->get();
        return view('pages.main.offers.index', [
            'mainSlider' => $mainSlider,
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function detailOffers($slug)
    {
        $data = Product::where('slug', $slug)->first();
        return view('pages.main.offers.details', [
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function detailWedding($slug)
    {
        $data = Product::where('slug', $slug)->first();
        return view('pages.main.wedding.details', [
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function experience()
    {
        $mainSlider = PageSlider::where('pages', 'experience')->first();
        $data = Experience::orderBy('id', 'DESC')->get();
        return view('pages.main.experience.index', [
            'mainSlider' => $mainSlider,
            'data'  => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function detailExperience($slug)
    {
        $data = Experience::where('slug', $slug)->first();
        return view('pages.main.experience.details', [
            'data' => $data,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function gallery()
    {
        $mainSlider = PageSlider::where('pages', 'gallery')->first();
        $gallery = Gallerie::orderBy('id', 'asc')->get();
        $slide = Gallerie::first();
        return view('pages.main.gallery.index', [
            'mainSlider' => $mainSlider,
            'slide' => $slide,
            'gallery'    => $gallery,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function contact()
    {
        $mainSlider = PageSlider::where('pages', 'contact')->first();
        return view('pages.main.contact.index', [
            'mainSlider' => $mainSlider,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function sendMail(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'additional' => $request->additional,
            'booking_value' => $request->booking_value,
            'country' => $request->country,
            'guest' => $request->guest,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        Mail::to($setting->email_reciver)->send(new NotifyMail($input));
        if (Mail::failures()) {
            return response()->json('Failed');
       }else{
            return response()->json('Done');
          }
    }

    // BLOG
    public function blog()
    {
        $featuredPosts = BlogPost::published()->featured()
            ->with(['categories', 'tags', 'author'])
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        $recentPosts = BlogPost::published()
            ->with(['categories', 'tags', 'author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $tags = BlogTag::orderBy('name')->get();

        return view('pages.main.blog.index', [
            'featuredPosts' => $featuredPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function blogDetail($slug)
    {
        $post = BlogPost::published()
            ->with(['categories', 'tags', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('blog_categories.id', $post->categories->pluck('id'));
            })
            ->take(3)
            ->get();

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $tags = BlogTag::orderBy('name')->get();

        return view('pages.main.blog.detail', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function blogByCategory($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $featuredPosts = BlogPost::published()->featured()
            ->with(['categories', 'tags', 'author'])
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('blog_categories.id', $category->id);
            })
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        $recentPosts = BlogPost::published()
            ->with(['categories', 'tags', 'author'])
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('blog_categories.id', $category->id);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $tags = BlogTag::orderBy('name')->get();

        return view('pages.main.blog.index', [
            'featuredPosts' => $featuredPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'tags' => $tags,
            'pageTitle' => 'Category: ' . $category->name,
            'pageSubtitle' => 'Browse all posts in the "' . $category->name . '" category',
            'sectionTitle' => $category->name,
            'emptyMessage' => 'No posts found in the "' . $category->name . '" category yet. Check back later!',
        ]);
    }

    public function blogByTag($slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();

        $featuredPosts = BlogPost::published()->featured()
            ->with(['categories', 'tags', 'author'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('blog_tags.id', $tag->id);
            })
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        $recentPosts = BlogPost::published()
            ->with(['categories', 'tags', 'author'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('blog_tags.id', $tag->id);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $tags = BlogTag::orderBy('name')->get();

        return view('pages.main.blog.index', [
            'featuredPosts' => $featuredPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'tags' => $tags,
            'pageTitle' => 'Tag: ' . $tag->name,
            'pageSubtitle' => 'Browse all posts tagged with "' . $tag->name . '"',
            'sectionTitle' => '#' . $tag->name,
            'emptyMessage' => 'No posts found with the tag "' . $tag->name . '" yet. Check back later!',
        ]);
    }

    public function blogSearch(Request $request)
    {
        $query = $request->get('q', '');

        $featuredPosts = collect();

        $recentPosts = BlogPost::published()
            ->with(['categories', 'tags', 'author'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                  ->orWhere('excerpt', 'LIKE', '%' . $query . '%')
                  ->orWhere('content', 'LIKE', '%' . $query . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $tags = BlogTag::orderBy('name')->get();

        return view('pages.main.blog.index', [
            'featuredPosts' => $featuredPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'tags' => $tags,
            'pageTitle' => 'Search: ' . $query,
            'pageSubtitle' => 'Search results for "' . $query . '"',
            'sectionTitle' => 'Results for "' . $query . '"',
            'emptyMessage' => 'No posts found matching "' . $query . '". Try different keywords!',
        ]);
    }
}

