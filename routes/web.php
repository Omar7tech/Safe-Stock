<?php

use App\Http\Controllers\admin\RequestController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\users\ProductController;
use App\Http\Controllers\users\CategoryController;
use App\Http\Controllers\users\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//*                  THIS IS DEFAULT ROUTE ("/")
//*      DEFUALT ROUTE CAN BE ACCESSED BE ADMIN-USER-GUEST
//*------------------------------------------------------------------------
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return view('admin.home');
        } elseif (Auth::user()->role === 'user') {
            return app()->make('App\Http\Controllers\users\ProductController')->home();
        }
    } else {
        return view('guest.welcome');
    }
})->name("home");








//?  --------------------------------------------------------------
//?  -                        GUEST ROUTES                        -
//?  --------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::any('/login', [AuthController::class, "login"])->name("login");
    Route::get('/register', function () {
        return view('guest.authentication.register');
    })->name("register");
    Route::get('/about', function () {
        return view('guest.about');
    })->name("about");
    Route::post("request/make", [RequestController::class, "store"])->name("request.create");
});




//*  --------------------------------------------------------------
//*  -                        ADMIN ROUTES                        -
//*  --------------------------------------------------------------

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('users/status', [UserController::class, "users_status"])->name("users.status");
    Route::patch('/admin/users/{id}/status', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::resource("users", UserController::class);
    Route::get("requests", [RequestController::class, "index"])->name("request.index");
    Route::get("/users/s/deleted", [UserController::class, "deleted"])->name("users.deleted");
    //Soft Delete
    Route::delete('user/{id}', [UserController::class, "delete"])->name("user.Softdelete");
    Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/favorite', [UserController::class, 'favorite'])->name('users.favorite');
    Route::get("/user/starred", [UserController::class, 'starred'])->name("users.starred");

    Route::get("admin-user-create", [UserController::class, "createUserFromAdmin"])->name("admin.create.user");
    Route::post("admin-user-create", [UserController::class, "storeUserFromAdmin"])->name("admin.store.user");
});




//!  --------------------------------------------------------------
//!  -                        USER ROUTES                         -
//!  --------------------------------------------------------------
Route::middleware(['auth', 'can:user', 'can:active'])->group(function () {
    Route::get('/user/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::resource("supplier", SupplierController::class);
    Route::get('suppliers/deleted', [SupplierController::class, "deleted"])->name("supplier.deleted");
    Route::post("suppliers/restore/{id}", [SupplierController::class, "restore"])->name("supplier.restore");
    Route::post("suppliers/delete/{id}", [SupplierController::class, "forceDelete"])->name("supplier.ForceDelete");
    Route::post('/supplier/pin/{id}', [SupplierController::class, 'pin'])->name('supplier.pin');
    Route::post('/supplier/unpin/{id}', [SupplierController::class, 'unpin'])->name('supplier.unpin');
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('deleted', [CategoryController::class, 'deleted'])->name('deleted');
        Route::post('restore/{id}', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('force-delete');
    });
    Route::resource('categories', CategoryController::class);
    Route::get('products/data', [ProductController::class, 'getData'])->name('products.data');

    Route::resource("products", ProductController::class);
});


//?  --------------------------------------------------------------
//!  -       Authenticated (Both admin and user) ROUTES           -
//? ---------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        if (Auth::user()->role === 'user') {
            dd();
        } elseif (Auth::user()->role === 'admin') {
            dd("hey");
        }
    })->name('user.profile');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect("/");
    })->name('auth.logout');

});
