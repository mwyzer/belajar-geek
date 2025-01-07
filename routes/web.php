<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route register index
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register')->middleware('guest');

//route register store
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store')->middleware('guest');

//route login index
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login')->middleware('guest');

//route login store
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store')->middleware('guest');

//route logout
Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout')->middleware('auth');

// Add these routes after the existing auth routes
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])
    ->name('auth.google.redirect')
    ->middleware('guest');

Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback')
    ->middleware('guest');

//prefix "account"
Route::prefix('account')->group(function () {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('/dashboard', App\Http\Controllers\Account\DashboardController::class)->name('account.dashboard');

        //route permissions
        Route::get('/permissions', \App\Http\Controllers\Account\PermissionController::class)->name('account.permissions.index')
            ->middleware('permission:permissions.index');

        //route resource roles
        Route::resource('/roles', \App\Http\Controllers\Account\RoleController::class, ['as' => 'account'])
            ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

        //route resource users
        Route::resource('/users', \App\Http\Controllers\Account\UserController::class, ['as' => 'account'])
            ->middleware('permission:users.index|users.create|users.edit|users.delete');

        //route resource colors
        Route::resource('/colors', \App\Http\Controllers\Account\ColorController::class, ['as' => 'account'])
            ->middleware('permission:colors.index|colors.create|colors.edit|colors.delete');

        //route resource warnas
        Route::resource('/warnas', \App\Http\Controllers\Account\WarnaController::class, ['as' => 'account'])
            ->middleware('permission:warnas.index|warnas.create|warnas.edit|warnas.delete');

        //route resource locations
        Route::resource('/locations', \App\Http\Controllers\Account\LocationController::class, ['as' => 'account'])
            ->middleware('permission:locations.index|locations.create|locations.edit');

        // Route resource Provider Locations
        Route::resource('/provider-locations', \App\Http\Controllers\Account\ProviderLocationController::class, ['as' => 'account'])
            ->middleware('permission:provider-locations.index|provider-locations.create|provider-locations.edit|provider-locations.delete|provider-locations.show');

        //Route resource Location Partners
        Route::resource('/location-partners', \App\Http\Controllers\Account\LocationPartnerController::class, ['as' => 'account'])
        ->middleware('permission:location-partners.index|location-partners.create|location-partners.edit|location-partners.delete|location-partners.show');
        
        // Prepaid Provider Resource Routes
        // Route::prefix('prepaid-providers')->group(function () {
        //     Route::get('/', [PrepaidProviderController::class, 'index'])->name('account.prepaid-providers.index');
        //     Route::post('/', [PrepaidProviderController::class, 'store'])->name('account.prepaid-providers.store');
        //     Route::get('/{prepaidProvider}', [PrepaidProviderController::class, 'show'])->name('account.prepaid-providers.show');
        //     Route::put('/{prepaidProvider}', [PrepaidProviderController::class, 'update'])->name('account.prepaid-providers.update');
        //     Route::delete('/{prepaidProvider}', [PrepaidProviderController::class, 'destroy'])->name('account.prepaid-providers.destroy');

        //     // Dynamic Package Routes
        //     Route::post('/{id}/packages', [PrepaidProviderController::class, 'addPackage'])->name('account.prepaid-providers.add-package');
        //     Route::delete('/{id}/packages/{index}', [PrepaidProviderController::class, 'removePackage'])->name('account.prepaid-providers.remove-package');
        // });

        //route resource Customers
        Route::resource('/customers', \App\Http\Controllers\Account\CustomerController::class, ['as' => 'account'])
            ->middleware('permission:customers.index|customers.create|customers.edit');

        //route resource categories
        Route::resource('/categories', \App\Http\Controllers\Account\CategoryController::class, ['as' => 'account'])
            ->middleware('permission:categories.index|categories.create|categories.edit|categories.delete');

        //route resource providers
        Route::resource('/providers', \App\Http\Controllers\Account\ProviderController::class, ['as' => 'account'])
            ->middleware('permission:providers.index|providers.create|providers.edit|providers.delete');

        //route resource VoucherProfile
        Route::resource('/voucher', \App\Http\Controllers\Account\VoucherProfileController::class, ['as' => 'account'])
            ->middleware('permission:voucher.index|voucher.create|voucher.edit|voucher.delete');

        //route resource sliders
        Route::resource('/sliders', App\Http\Controllers\Account\SliderController::class, ['except' => ['create', 'show', 'edit', 'update'], 'as' => 'account'])
            ->middleware('permission:sliders.index|sliders.create|sliders.delete');

        //route store image product
        Route::post('/products/store_image_product', [\App\Http\Controllers\Account\ProductController::class, 'storeImageProduct'])->name('account.products.store_image_product');

        //route destroy image product
        Route::delete('/products/destroy_image_product/{id}', [\App\Http\Controllers\Account\ProductController::class, 'destroyImage'])->name('account.products.destroy_image_product');

        //route resource products
        Route::resource('/products', \App\Http\Controllers\Account\ProductController::class, ['as' => 'account'])
            ->middleware('permission:products.index|products.create|products.show|products.edit|products.delete');

        //route transactions index
        Route::get('/transactions', [App\Http\Controllers\Account\TransactionController::class, 'index'])->name('account.transactions.index')
            ->middleware('permission:transactions.index');

        //route transactions show
        Route::get('/transactions/{invoice}', [App\Http\Controllers\Account\TransactionController::class, 'show'])->name('account.transactions.show')
            ->middleware('permission:transactions.show');

        // Route for listing transactions of a specific user
        Route::get('/transactions/user/{userId}', [App\Http\Controllers\Account\TransactionController::class, 'userTransactions'])
            ->name('account.transactions.user')
            ->middleware('permission:transactions.user');
    });
});
/**
 * route home
 */
Route::get('/', \App\Http\Controllers\Web\HomeController::class)->name('web.home.index');

/**
 * route category index
 */
Route::get('/categories', [\App\Http\Controllers\Web\CategoryController::class, 'index'])->name('web.categories.index');

/**
 * route category show
 */
Route::get('/categories/{slug}', [\App\Http\Controllers\Web\CategoryController::class, 'show'])->name('web.categories.show');

/**
 * route products index
 */
Route::get('/products', [\App\Http\Controllers\Web\ProductController::class, 'index'])->name('web.products.index');

/**
 * route products show
 */
Route::get('/products/{slug}', [\App\Http\Controllers\Web\ProductController::class, 'show'])->name('web.products.show');

/**
 * route cart index
 */
Route::get('/carts', [\App\Http\Controllers\Web\CartController::class, 'index'])->name('web.carts.index')
    ->middleware('auth');

/**
 * route cart store
 */
Route::post('/carts', [\App\Http\Controllers\Web\CartController::class, 'store'])->name('web.carts.store')
    ->middleware('auth');

/**
 * route cart delete
 */
Route::delete('/carts/{id}', [\App\Http\Controllers\Web\CartController::class, 'destroy'])->name('web.carts.destroy')
    ->middleware('auth');

/**
 * route checkouts index
 */
Route::get('/checkouts', [\App\Http\Controllers\Web\CheckoutController::class, 'index'])->name('web.checkouts.index')
    ->middleware('auth');

/**
 * route checkouts get cities by province ID
 */
Route::get('/checkouts/cities', [\App\Http\Controllers\Web\CheckoutController::class, 'getCities'])->name('web.checkouts.getCities')
    ->middleware('auth');

/**
 * route checkOngkir
 */
Route::post('/checkouts/checkOngkir', [\App\Http\Controllers\Web\CheckoutController::class, 'checkOngkir'])->name('web.checkouts.checkOngkir')
    ->middleware('auth');

/**
 * route checkout store
 */
Route::post('/checkouts', [\App\Http\Controllers\Web\CheckoutController::class, 'store'])->name('web.checkouts.store')
    ->middleware('auth');

/**
 * route callback
 */
Route::post('/callback', \App\Http\Controllers\Web\CallbackController::class)->name('web.callback');