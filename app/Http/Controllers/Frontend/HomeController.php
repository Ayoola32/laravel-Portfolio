<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSettings;
use App\Models\ContactSettings;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\FeedbackSettings;
use App\Models\Hero;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\PortfolioSettings;
use App\Models\Service;
use App\Models\SkillsItem;
use App\Models\SkillsSettings;
use App\Models\TyperTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //
    function index()
    {
        $hero = Hero::first();
        $typerTitles = TyperTitle::all();
        $services = Service::all();
        $about = About::first();
        $portfolioSettings = PortfolioSettings::first();
        $portfolioCategories = PortfolioCategory::whereHas('items', function ($q) {
            $q->where('status', 'published');
        })->with(['items' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        $portfolioItems = PortfolioItem::where('status', 'published')->get();
        $skillsSettings = SkillsSettings::first();
        $skillsItems = SkillsItem::all();
        $experience = Experience::first();
        $feedbacks = Feedback::all();
        $feedbackSettings = FeedbackSettings::first();
        $blogSettings = BlogSettings::first();
        $blogs = Blog::where('status', 'published')->latest()->limit(3)->get();
        $ContactSettings = ContactSettings::first();


        return view(
            'frontend.home',
            compact(
                'hero',
                'typerTitles',
                'services',
                'about',
                'portfolioSettings',
                'portfolioCategories',
                'portfolioItems',
                'skillsSettings',
                'skillsItems',
                'experience',
                'feedbacks',
                'feedbackSettings',
                'blogSettings',
                'blogs',
                'ContactSettings',
            )
        );
    }

    function showPortfolio($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolioItem'));
    }

    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 'published')->first();
        if (!$blog) {
            return redirect('/');
        }

        $blogs = Blog::where('status', 'published')->get();
        if ($blogs->isEmpty()) {
            return redirect('/');
        }
    
        $previousPost = Blog::where('status', 'published')
            ->where('id', '<', $blog->id)
            ->where('slug', '!=', $blog->slug)
            ->orderBy('id', 'desc')
            ->first();
    
        $nextPost = Blog::where('status', 'published')
            ->where('id', '>', $blog->id)
            ->where('slug', '!=', $blog->slug)
            ->orderBy('id', 'asc')
            ->first();

        $blogCategories = BlogCategory::whereHas('items', function ($q) {
            $q->where('status', 'published');
        })->with(['items' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('frontend.blog-details', compact('blog', 'blogs', 'previousPost', 'nextPost', 'blogCategories'));
    }
    

    function blog()
    {
        $blogs = Blog::where('status', 'published')->latest()->paginate(9);
        if ($blogs->isEmpty()) {
            return redirect('/');
        }

        $blogCategories = BlogCategory::whereHas('items', function ($q) {
            $q->where('status', 'published');
        })->with(['items' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('frontend.blog', compact('blogs', 'blogCategories'));
    }

    function contact(Request $request){
        $request->validate([
            'name' => ['required', 'max:200'],
            'subject' => ['required', 'max:250'],
            'email' => ['required', 'email'],
            'message' => ['required', 'max:2000'],
        ]);

        Mail::send(new ContactMail($request->all()));
        return response(['status' => 'success', 'message' => 'Mail Sent Successfully!']);
    }

    public function blogCategory($slug)
    {
        // Fetch the selected category or redirect
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        // Get only categories that have published blog items
        $blogCategories = BlogCategory::where('id', '!=', $category->id)
        ->whereHas('items', function ($query) {
            $query->where('status', 'published');
        })->withCount(['items as published_count' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        // Fetch published blogs under the selected category
        $blogs = Blog::where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        // Redirect if no blogs found
        if ($blogs->isEmpty()) {
            return redirect('/');
        }

        return view('frontend.blog-category', compact('blogs', 'category', 'blogCategories'));
    }
}
