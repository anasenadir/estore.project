<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailsController;
use App\Http\Controllers\PurchaseRecieptsController;
use App\Http\Controllers\SeleController;
use App\Http\Controllers\SeleRecieptsController;
use App\Http\Controllers\SupplierController;
use App\Models\ProductCategory;
use App\Models\SeleReciepts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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



Auth::routes(['register'=>false]);
// Auth::routes();



Route::get('/', function () {
    return view('auth.login');
})->middleware(['notAuthenticate']);


Route::middleware(['auth'])->group(function(){
    Route::resource('productCategories', ProductCategoriesController::class);

    //product routes========================================
    Route::resource('products', ProductController::class);
    Route::get('markAllAsRead' , [ProductController::class , 'markAllAsRead'])->name('markAllAsRead');
    //=======================================================

    Route::resource('suppliers' , SupplierController::class);
    Route::resource('clients' , ClientController::class);
    // Route::get('seles/dounload/{id}' ,[SeleController::class, 'dounload'])->name('dounload');
    // Route::get('seles/sendMail/{id}' ,[SeleController::class, 'sendMail'])->name('sendMail');
    
    
    Route::controller(SeleController::class)->group(function(){
        Route::get('seles/seleInvoiceDounload/{id}' ,'seleInvoiceDounload')->name('seleInvoiceDounload');
        Route::get('seles/sendSeleByMail/{id}' , 'sendSeleByMail')->name('sendSeleByMail');
        Route::get('seles/viewSeleInvoice/{id}' ,'viewSeleInvoice')->name('viewSeleInvoice');
        Route::get('seles/convertToSeleContract/{id}' ,'convertPrInvoiceToSeleContract')->name('convertToSeleContract');
        Route::get('seles/invoiceTooked/{id}' , 'invoiceTooked')->name('invoiceTooked');
    });
    Route::resource('seles' , SeleController::class);




    Route::controller(PurchaseController::class)->group(function(){
        Route::get('purchases/dounload/{id}' ,'dounload')->name('purchaseInvoiceDounload');
        Route::get('purchases/sendPurchaseByMail/{id}' , 'sendPurchaseByMail')->name('sendPurchaseByMail');
        Route::get('purchases/viewPurchaseInvoice/{id}' ,'viewPurchaseInvoice')->name('viewPurchaseInvoice');
        // Route::get('seles/convertToSeleContract/{id}' ,'convertPrInvoiceToSeleContract')->name('convertToSeleContract');
        Route::get('purchases/purchasesReceived/{id}' , 'purchasesReceived')->name('purchasesReceived');
    });
    Route::resource('purchases' , PurchaseController::class);
    // Route::get('seles/dounload' , [SeleController::class, 'dounload']);
    Route::resource('selesrecipets' , SeleRecieptsController::class);
    Route::resource('purchasesrecipets' , PurchaseRecieptsController::class);
    
    // pricing controller  
    Route::controller(PricingController::class)->group(function(){
        Route::get('pricing/viewPricingInvoice/{id}' ,'viewPricingInvoice')->name('viewPricingInvoice');
        Route::get('pricing/dounload/{id}' ,'dounload')->name('dounload');
        Route::get('pricing/sendMail/{id}' , 'sendMail')->name('sendMail');
        
        // Route::get('pricing/invoiceTooked/{id}' , 'invoiceTooked')->name('invoiceTooked');
    });
    Route::resource('pricing', PricingController::class);


    // profile controller 

    // Route::controller(ProfileController::class)->group(function(){
    //     Route::get('profile/accountSettings' , 'AccountSettings')->name('accountSettings');
    // });
    
    
    // Route::prefix('profile')->group(function(){
    // });
    Route::prefix('companysettings')->group(function(){
        Route::get('/' , [CompanyController::class , 'index'])->name('companyinfo');
        Route::post('/update' , [CompanyController::class , 'update'])->name('updatecompanyinfo');
    });
    // Route::get('companysettings'  , []);


    
    Route::prefix('profile' )->group(function(){
        Route::get('/updateprofile' , [ProfileController::class , 'updateProfile'])->name('updateProfile');
    });
    Route::resource('profile' , ProfileController::class);





    Route::get('/{page}' ,[ AdminController::class , 'index']);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
