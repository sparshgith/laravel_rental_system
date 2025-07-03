<?php

// All necessary controllers and models are included
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// The homepage route, pointing to your welcome blade file.
Route::get('/', function () {
    return view('welcome');
});

// The public-facing page for tenants to view properties.
Route::get('/listed-properties', [PropertyController::class, 'publicIndex'])->name('properties.public.index');


/*
|--------------------------------------------------------------------------
| Authenticated Routes (Admin Panel)
|--------------------------------------------------------------------------
|
| These routes require the user to be logged in. We've kept your
| 'verified' middleware as it was likely intended for your setup.
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Route with statistics (preserved from your original file)
    Route::get('/dashboard', function () {
        $propertyCount = Property::count();
        $tenantCount = Tenant::count();
        $occupiedCount = Property::where('is_occupied', true)->count();

        return view('dashboard', compact('propertyCount', 'tenantCount', 'occupiedCount'));
    })->name('dashboard');

    // --- Resource Routes for Admin CRUD ---
    // All of your resource controllers have been kept.
    Route::resource('properties', PropertyController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('leases', LeaseController::class)->only(['index', 'create', 'store', 'destroy']);

    // --- User Profile Routes ---
    // Preserved from your original file.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// in routes/web.php

// ... your existing routes for the public site ...

// ===================================================
// ============== ADMIN PANEL ROUTES =================
// ===================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard Route
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // We will create this view next
    })->name('dashboard');

    // These lines create all the CRUD routes for our models inside the admin panel
    // pointing to controllers inside an 'Admin' subfolder.
    Route::resource('properties', \App\Http\Controllers\Admin\PropertyController::class);
    Route::resource('tenants', \App\Http\Controllers\Admin\TenantController::class);
    Route::resource('leases', \App\Http\Controllers\Admin\LeaseController::class)->only(['index', 'create', 'store', 'destroy']);

});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| This file includes all routes for login, registration, password reset, etc.
*/
require __DIR__.'/auth.php';
