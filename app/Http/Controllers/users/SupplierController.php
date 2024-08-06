<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // Query the suppliers associated with the authenticated user
        $suppliersQuery = $user->suppliers()->orderBy('pinned', 'desc')->orderBy('name');

        if ($request->filled('name')) {
            $suppliersQuery->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $suppliersQuery->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('contact_person')) {
            $suppliersQuery->where('contact_person', 'like', '%' . $request->input('contact_person') . '%');
        }

        // Paginate the results
        $suppliers = $suppliersQuery->paginate(10)->withQueryString(); // Adjust pagination limit as needed

        return view('user.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = auth()->user();
        $supplier = $user->suppliers()->findOrFail($decodedId[0]);
        return view('user.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = auth()->user();
        $supplier = $user->suppliers()->findOrFail($decodedId[0]);
        return view("user.supplier.edit", compact("supplier"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email,' . $decodedId[0],
            'contact_person' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'tax_id' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $user = auth()->user();
        $supplier = $user->suppliers()->findOrFail($decodedId[0]);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = auth()->user();
        $supplier = $user->suppliers()->findOrFail($decodedId[0]);
        $supplier->delete(); // You can use delete() if you want to soft delete instead of permanent delete
        return redirect()->route("supplier.index");

    }
    public function deleted(Request $request)
    {

        $user = auth()->user();

        // Query the suppliers associated with the authenticated user
        $suppliersQuery = $user->suppliers()->onlyTrashed();

        // Apply filters based on request inputs
        if ($request->filled('name')) {
            $suppliersQuery->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $suppliersQuery->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('contact_person')) {
            $suppliersQuery->where('contact_person', 'like', '%' . $request->input('contact_person') . '%');
        }

        // Paginate the results
        $suppliers = $suppliersQuery->paginate(10)->withQueryString(); // Adjust pagination limit as needed
        return view("user.supplier.deleted", compact("suppliers"));
    }

    public function restore(string $id)
    {

        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = auth()->user();
        $suppliers = $user->suppliers()->onlyTrashed()->findOrFail($decodedId[0]);
        $suppliers->restore();
        return redirect()->route("supplier.deleted");
    }

    public function forceDelete(string $id)
    {

        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = auth()->user();
        $supplier = $user->suppliers()->onlyTrashed()->findOrFail($decodedId[0]);
        $supplier->forceDelete(); // You can use delete() if you want to soft delete instead of permanent delete
        return redirect()->route("supplier.deleted");

    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'contact_person' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'tax_id' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Create a new supplier associated with the authenticated user
        $user = auth()->user();
        $user->suppliers()->create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }

    public function create()
    {
        return view("user.supplier.create");
    }

    public function pin(Request $request, $id)
    {
        $supplier = Supplier::findOrFail(Hashids::decode($id)[0]);
        $supplier->pinned = true;
        $supplier->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'pinned' => true]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier pinned successfully.');
    }

    public function unpin(Request $request, $id)
    {
        $supplier = Supplier::findOrFail(Hashids::decode($id)[0]);
        $supplier->pinned = false;
        $supplier->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'pinned' => false]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier unpinned successfully.');
    }

}
