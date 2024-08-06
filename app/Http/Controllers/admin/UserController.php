<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users_status(Request $request)
    {
        $usersQuery = User::query();
        if ($request->has('n')) {
            $searchTerm = $request->query('n');
            $usersQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }
        $filter = $request->query('rg2', 'all');
        switch ($filter) {
            case 'active':
                $usersQuery->where('active', true);
                break;
            case 'inactive':
                $usersQuery->where('active', false);
                break;
            default:
                break;
        }
        $users = $usersQuery->where("role", "user")->latest()->paginate(10)->withQueryString();
        $activeUsersCount = User::where('active', true)->where("role", "user")->count();
        $inactiveUsersCount = User::where('active', false)->where("role", "user")->count();
        return view('admin.users.status', [
            'users' => $users,
            'activeUsersCount' => $activeUsersCount,
            'inactiveUsersCount' => $inactiveUsersCount,
        ]);
    }


    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->active = $request->status == 'true' ? 1 : 0;
            $user->save();
            return Response::json(['success' => true]);
        }
        return Response::json(['success' => false], 404);
    }




    public function index(Request $request)
    {
        $query = User::where('role', 'user')->whereNull("deleted_at");

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->input('mobile') . '%');
        }

        if ($request->filled('joined_at')) {
            $query->whereDate('created_at', '=', $request->input('joined_at'));
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.users.data', compact('users'));
    }


    public function edit($id)
    {
        $decodedId = Hashids::decode($id);

        if (count($decodedId) === 0) {
            abort(404);
        }

        $user = User::findOrFail($decodedId[0]);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $decodedId = Hashids::decode($id);

        if (count($decodedId) === 0) {
            return response()->json(['error' => 'Invalid user ID'], 404);
        }

        $user = User::findOrFail($decodedId[0]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required|integer|max:255|unique:users,mobile,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();

        return response()->json(['success' => 'User updated successfully']);
    }

    public function show($id)
    {
        $decodedId = Hashids::decode($id);
        if (count($decodedId) === 0) {
            abort("404");
        }
        $user = User::findOrFail($decodedId[0]);
        return view("admin.users.show", compact("user"));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true, 'userId' => $id]);
    }

    public function deleted(Request $request)
    {

        $query = \DB::table('users')->where('role', 'user')->whereNotNull('deleted_at');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->input('mobile') . '%');
        }
        if ($request->filled('joined_at')) {
            $query->whereDate('created_at', '==', $request->input('joined_at'));
        }
        $query->orderBy('created_at', 'desc');
        $users = $query->latest()->paginate(15)->withQueryString();
        return view('admin.users.deleted', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return response()->json(['success' => 'User restored successfully.']);
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return response()->json(['success' => 'User deleted successfully.']);
    }


    public function favorite(Request $request, User $user)
    {
        $adminId = auth()->id();
        $favorited = $user->favorites()->where('admin_id', $adminId)->exists();
        if ($favorited) {
            $user->favorites()->where('admin_id', $adminId)->delete();
            $favorited = false;
        } else {
            $user->favorites()->create(['admin_id' => $adminId]);
            $favorited = true;
        }
        return response()->json([
            'status' => 'success',
            'favorited' => $favorited,
        ]);
    }

    public function starred()
    {
        $favorites = Favorite::where("admin_id", Auth()->user()->id)->paginate(20);
        $favoriteUserIds = $favorites->pluck('user_id');
        $activeUsersCount = User::whereIn('id', $favoriteUserIds)->where('active', true)->count();
        $totalCount = $favorites->total();
        return view("admin.users.starred", compact("favorites", "activeUsersCount", "totalCount"));
    }


    public function createUserFromAdmin()
    {
        return view('admin.users.createUser');
    }

    public function storeUserFromAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|numeric|digits_between:1,15|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.create.user')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => \Hash::make($request->password),
            'role' => $request->role,
            'active' => $request->active,
        ]);

        return redirect()->route('admin.create.user')->with('success', 'User created successfully!');
    }


}
