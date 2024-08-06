<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    // Get the categories for the authenticated user, optionally filtered by search query
    $categories = Category::withCount('products') // Eager load the products relationship and count
        ->where('user_id', auth()->user()->id)
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('products_count', 'desc') // Sort by the product count
        ->paginate(10);

    return view('user.category.index', compact('categories', 'search'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
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
    // Decode the hash to get the category ID
    $decoded = Hashids::decode($id);

    if (!empty($decoded) && isset($decoded[0])) {
        $categoryId = $decoded[0];
        $category = Category::findOrFail($categoryId);

        return view('user.category.edit', compact('category'));
    } else {
        abort(404, 'Category not found.');
    }
}



    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, string $id)
{
    // Decode the hash to get the category ID
    $decoded = Hashids::decode($id);

    if (!empty($decoded) && isset($decoded[0])) {
        $categoryId = $decoded[0];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the category
        $category = Category::findOrFail($categoryId);
        $category->update($request->only(['name', 'description']));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    } else {
        abort(404, 'Category not found.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Decode the hash to get the category ID
    $decoded = Hashids::decode($id);

    if (!empty($decoded) && isset($decoded[0])) {
        $categoryId = $decoded[0];
        $category = Category::findOrFail($categoryId);

        // Soft delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    } else {
        abort(404, 'Category not found.');
    }
}

public function deleted(){

    $categories = Category::onlyTrashed()->where("user_id" , Auth()->user()->id)->paginate();
    return view("user.category.deleted" , compact("categories"));
}


public function restore(string $id)
{
    // Decode the hash to get the category ID
    $decoded = Hashids::decode($id);

    if (!empty($decoded) && isset($decoded[0])) {
        $categoryId = $decoded[0];
        $category = Category::onlyTrashed()->findOrFail($categoryId);

        // Restore the category
        $category->restore();

        return redirect()->route('categories.deleted')->with('success', 'Category restored successfully.');
    } else {
        abort(404, 'Category not found.');
    }
}

/**
 * Permanently delete a soft-deleted resource.
 */
public function forceDelete(string $id)
{
    // Decode the hash to get the category ID
    $decoded = Hashids::decode($id);

    if (!empty($decoded) && isset($decoded[0])) {
        $categoryId = $decoded[0];
        $category = Category::onlyTrashed()->findOrFail($categoryId);

        // Permanently delete the category
        $category->forceDelete();

        return redirect()->route('categories.deleted')->with('success', 'Category permanently deleted.');
    } else {
        abort(404, 'Category not found.');
    }
}
}
