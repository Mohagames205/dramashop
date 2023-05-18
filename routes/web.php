<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Models\Product;
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

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/request/{id}', [RequestController::class, 'order']);
Route::post('/request/{product_id}', [RequestController::class, 'create'])->name('request.create');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix("product")->group(function () {

        Route::get("/", function () {
            return view("product.overview");
        })->name("products");

        Route::get("create", function () {
            return view("product.create");
        });

        Route::patch("{id}", [ProductController::class, "update"])->name("product.update");
        Route::delete("{id}", [ProductController::class, "delete"])->name("product.delete");

        Route::get("{id}", function (int $id) {
            return view("product.product", ["product" => Product::where("id", $id)->firstOrFail()]);
        });

        Route::post("/", [ProductController::class, 'create'])->name("product.create");

    });


    Route::get("/requests", function () {
        return view("requests");
    })->name("requests");

    Route::get("/requestview/{id}", [RequestController::class, "index"]);

    Route::delete("/requestview/{id}", [RequestController::class, "delete"])->name("request.delete");

    Route::patch("/requestview/{id}", [RequestController::class, "update"])->name("request.update");


});

Route::get("/tracking/{unique_id}", function (string $id) {
    return view("request.personaltracking", ["request" => \App\Models\Request::where("unique_identifier", $id)->firstOrFail()]);
});


Route::delete("/tracking/{unique_id}", [RequestController::class, "deletePersonal"]);

require __DIR__.'/auth.php';
