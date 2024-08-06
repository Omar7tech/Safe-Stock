<?php

namespace App\Http\Controllers\users;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends Controller
{

    public function getData(Request $request)
    {
        $products = Product::where('user_id', Auth::id())->with(['supplier', 'images'])->select('products.*');

        return DataTables::eloquent($products)
            /* ->addColumn('image', function ($product) {
                if ($product->images->isNotEmpty()) {
                    return '<img src="' . Storage::url($product->images->first()->image_path) . '"  class="img-thumbnail" style="width: 50px;">';
                } else {
                    return '<img src="https://via.placeholder.com/150" alt="No Image" class="img-thumbnail" style="width: 50px;">';
                }
            }) */
            ->addColumn('supplier', function ($product) {
                return $product->supplier->name;
            })
            ->addColumn('actions', function ($product) {
                return '
                <div class="btn-group" role="group" aria-label="Actions">
                    <a href="' . route('products.show', Hashids::encode($product->id)) . '" class="btn btn-success btn-sm" title="Show">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="' . route('products.edit', Hashids::encode($product->id)) . '" class="btn btn-primary btn-sm" title="Edit">
                       <i class="bi bi-pen"></i>
                    </a>
                    <form action="' . route('products.destroy', Hashids::encode($product->id)) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>';
            })
            ->rawColumns(['image', 'actions'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get categories and suppliers associated with the logged-in user
        $categories = Category::whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->get();

        $suppliers = Supplier::where('user_id', Auth::id())->get();

        return view('user.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'is_active' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Optional images validation
        ]);

        // Decode hashed IDs
        $categoryId = Hashids::decode($validatedData['category_id']);
        $supplierId = Hashids::decode($validatedData['supplier_id']);

        // Ensure IDs are valid
        if (empty($categoryId)) {
            return back()->withErrors(['category_id' => 'Invalid category selected.'])->withInput();
        }
        if (!is_null($supplierId) && empty($supplierId)) {
            return back()->withErrors(['supplier_id' => 'Invalid supplier selected.'])->withInput();
        }

        $validatedData['category_id'] = $categoryId[0];
        $validatedData['supplier_id'] = $supplierId[0];

        // Create the product
        $product = new Product($validatedData);
        $product->user_id = Auth::id(); // Set the logged-in user's ID
        $product->save();

        // Handle product images if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store image and get its path
                $path = $image->store('public/product_images');

                // Hash the path using Vinkla Hash
                $hashedPath = Hashids::encode($path);

                // Assuming you have an `images` relationship or table to store image paths
                $product->images()->create([
                    'image_path' => $path // Store the hashed path
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort(404);
        }

        $product = auth()->user()->products()->with(['category', 'supplier', 'images'])->findOrFail($decodedId[0]);

        return view('user.products.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort(404);
        }

        $product = auth()->user()->products()->with(['category', 'supplier', 'images'])->findOrFail($decodedId[0]);
        $categories = Category::whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->get();

        $suppliers = Supplier::where('user_id', Auth::id())->get();

        return view('user.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort(404);
        }

        $product = auth()->user()->products()->findOrFail($decodedId[0]);

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'required',
            'supplier_id' => 'nullable',
            'is_active' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Optional images validation
        ]);

        // Decode hashed IDs
        $categoryId = Hashids::decode($validatedData['category_id']);
        $supplierId = Hashids::decode($validatedData['supplier_id']);

        // Ensure IDs are valid
        if (empty($categoryId)) {
            return back()->withErrors(['category_id' => 'Invalid category selected.'])->withInput();
        }
        if (!is_null($supplierId) && empty($supplierId)) {
            return back()->withErrors(['supplier_id' => 'Invalid supplier selected.'])->withInput();
        }

        $validatedData['category_id'] = $categoryId[0];
        $validatedData['supplier_id'] = $supplierId[0];

        // Update the product
        $product->update($validatedData);

        // Handle product images if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store image and get its path
                $path = $image->store('public/product_images');

                // Hash the path using Vinkla Hash
                $hashedPath = Hashids::encode($path);

                // Assuming you have an `images` relationship or table to store image paths
                $product->images()->create([
                    'image_path' => $path // Store the hashed path
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort(404);
        }

        $product = auth()->user()->products()->with('images')->findOrFail($decodedId[0]);

        // Delete each image from storage
        foreach ($product->images as $image) {
            Storage::delete($image->image_path);
            $image->delete();
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function home()
{
    $userId = Auth::user()->id;

    // Basic statistics
    $totalProducts = Product::where('user_id', $userId)->count();
    $totalCategories = Category::where('user_id', $userId)->count();
    $totalSuppliers = Supplier::where('user_id', $userId)->count();

    // More detailed statistics
    $productsPerCategory = Category::whereHas('products', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->withCount('products')->get();

    $productsPerSupplier = Supplier::whereHas('products', function ($query) {
        $query->where('user_id', Auth::user()->id );
    })->withCount('products')->get();

    // Using SQLite-compatible date functions
    $monthlyProductCount = Product::where('user_id', $userId)
        ->selectRaw('strftime("%Y", created_at) as year, strftime("%m", created_at) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->get();


    return view('user.home', compact(
        'totalProducts',
        'totalCategories',
        'totalSuppliers',

        'productsPerCategory',
        'productsPerSupplier',
        'monthlyProductCount'
    ));
}




}
