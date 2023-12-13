<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.categories.category', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create-category');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'                 =>          ['required', 'max:255', 'unique:categories,name'],
            'image'                =>          ['required', 'max:10000']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageFileName = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images/category_pictures', $imageFileName, 'public');

            $imagePath = 'images/category_pictures/' . $imageFileName;
        }

        $category = Category::create([
            'image'    =>              $imagePath,
            'name'          =>              $request->name
        ]);

        $log_entry = Auth::user()->fname . " added a new category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        return redirect('admin/categories')->with('message', 'Category added successfully.');
    }

    public function updateCategory(Category $category)
    {
        return view('admin.categories.edit-category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'          =>          ['required', 'max:255', 'unique:categories,name->ignore($request->category->id)']
        ]);


        $imagePath = $category->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageFileName = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images/product_pictures', $imageFileName, 'public');

            $imagePath = 'images/product_pictures/' . $imageFileName;

            if ($category->image && !Str::contains($category->image, '3237155-200.png')) {
                Storage::disk('public')->delete($category->image);
            }
        }

        $category->update([
            'image'         =>              $imagePath,
            'name'          =>              $request->name
        ]);

        $log_entry = Auth::user()->fname . " updated an category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        return redirect('admin/categories')->with('message', 'Category updated successfully.');
    }

    public function delete(Category $category)
    {

        $log_entry = Auth::user()->fname . " deleted the category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        $category->delete();
        return redirect('admin/categories')->with('message', 'Category deleted successfully.');
    }

    public function searchCategory(Request $request)
    {
        $search = $request->search;

        $categories = Category::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.categories.category-searched', compact('categories', 'search'));
    }
}
