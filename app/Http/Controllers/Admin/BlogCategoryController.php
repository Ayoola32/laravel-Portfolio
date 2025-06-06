<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $slug = Str::slug($request->name);
        // Check if the slug already exists
        if (BlogCategory::where('slug', $slug)->exists()) {
            toastr()->error('Category already exists');
            return redirect()->back()->withInput();
        }

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->save();

        toastr()->success('Blog category created successfully');
        return redirect()->route('admin.blog-category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $slug = Str::slug($request->name);
        $category = BlogCategory::findOrFail($id);
        // Check if the slug already exists
        if(
            BlogCategory::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists()
        ){
            toastr()->error('Category already exists');
            return redirect()->back()->withInput();
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->save();

        toastr()->success('Blog category updated successfully');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = BlogCategory::findOrFail($id);   
        $hasItem  = Blog::where('category_id', $category->id)->exists();
    
        if ($hasItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete category with associated Blog.'
            ]);
        }
 
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ]);
    }
}
