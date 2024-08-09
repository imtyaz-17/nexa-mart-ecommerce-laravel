<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('shop');
Route::get('/product/{slug?}',[ShopController::class,'product'])->name('product');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // Image Upload Route - Dropzone
        Route::post('/image/upload/{folder}',[ImageUploadController::class, 'uploadImage'])->name('image.upload');
        // Delete Upload Image Route
        Route::delete('/image/delete/{image}',[ImageUploadController::class, 'deleteImage'])->name('image.delete');

        // Category Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

        // Sub Category Routes
        Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('admin.subcategories.index');
        Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('admin.subcategories.create');
        Route::post('/subcategories/store', [SubCategoryController::class, 'store'])->name('admin.subcategories.store');
        Route::get('/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('admin.subcategories.edit');
        Route::put('/subcategories/{subcategory}', [SubCategoryController::class, 'update'])->name('admin.subcategories.update');
        Route::delete('/subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('admin.subcategories.delete');

        // Brand Routes
        Route::get('/brands',[BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/brands/create',[BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands/store',[BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/{brand}/edit',[BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.delete');

        // Product Routes
        Route::get('/products',[ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create',[ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/product-subcategories/{categoryId}',[ProductController::class, 'productSubcategories']);
        Route::post('/products/store',[ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit',[ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.delete');
   });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
