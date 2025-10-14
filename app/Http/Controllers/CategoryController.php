<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a default listing of categories resource.
     */
    public function list(Request $request)
    {
        $activeCategoryType = $request->input('categoryType', session('activeCategoryType', 'expense'));

        $parentCategories = Category::with(['children' => function($query) {
                                          $query->orderBy('name');
                                      }])
                                      ->where('type', $activeCategoryType)
                                      ->whereNull('parent_id')
                                      ->orderBy('name')
                                      ->get();

        return view('list', compact('activeCategoryType',
                                    'parentCategories'));
    }

    /**
     * Show the form for creating a new category resource.
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
                                    ->orderBy('name')
                                    ->get();

        return view('create', compact('parentCategories'));
    }

    /**
     * Store a newly created category resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
               ->route('list', [
                    'categoryType' => $request->input('type')
                ])
               ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing a category resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
                                    ->where('id', '!=', $category->id)
                                    ->orderBy('name')
                                    ->get();

        return view('edit', compact('category',
                                    'parentCategories'));
    }

    /**
     * Update edited category resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
               ->route('list', [
                    'categoryType' => $request->input('type')
                ])
               ->with('success', 'Category updated successfully.');
    }

    /**
     * Delete category resource in storage.
     */
    public function destroy(Category $category)
    {
        // Delete children transactions
        foreach ($category->children as $child) {
            $child->delete();
        }

        // Delete category
        $category->delete();

        return redirect('/')
               ->with('success', 'Category deleted successfully.');
    }
}
