<?php

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

/**
 * Install route
 */
Route::prefix('install')->group(function (){
   Route::get('/database','InstallController@database');

   Route::post('/save-database','InstallController@databaseSetup');

   Route::middleware(['install'])->group(function (){
       Route::get('/mail','InstallController@mail');
       Route::get('/admin','InstallController@admin');
       Route::get('/localization','InstallController@localization');
       Route::get('/tax','InstallController@tax');
       Route::get('/finish','InstallController@finish');

       Route::post('/skip-mail','InstallController@skipMail');
       Route::post('/save-mail','InstallController@mailSetup');
       Route::post('/save-admin','InstallController@postAdmin');
       Route::post('/save-local','InstallController@saveLocal');
       Route::post('/save-tax','InstallController@saveTax');
       Route::post('/to-login','InstallController@toLogin');
   });
});

Route::get('/account-disabled',function (){
    return view('messages.account-disabled');
});

Route::get('/not-permitted',function (){
    return view('messages.permission-denied');
});

Route::get('/config-cache',function (){
   \Illuminate\Support\Facades\Artisan::call('config:cache');
   return view('messages.cache-config');
});

Route::get('/','HomeController@welcome');
Route::get('/outlet/id={id}','HomeController@outlet');
Route::post('/outlet/id={id}/save-customer','CustomerController@saveCustomer');
Route::post('/outlet/id={id}/save-customer-order','POSController@customerOrder');



Auth::routes();

// Only active user can access theses route
Route::middleware(['auth','active.user.only'])->group(function (){

    Route::get('/profile','HomeController@adminProfile');
    Route::post('/update-profile/{id}','HomeController@updateProfile');
    Route::post('/change-password','HomeController@changePassword');

    //Outlet
    Route::get('/outlets', 'OutletController@index');
    Route::get('/new-outlet', 'OutletController@newOutlet');
    Route::get('/edit-outlet/{id}', 'OutletController@editOutlet');
    Route::post('/save-outlet', 'OutletController@saveOutlet');
    Route::post('/update-outlet/{id}', 'OutletController@updateOutlet');
    Route::get('/delete-outlet/{id}','OutletController@deleteOutlet');

    Route::get('/outlet-charge','OutletController@outletCharge');
    Route::get('/new-payment/outlet={id}','OutletPaymentController@newPayment');
    Route::post('/save-payment','OutletPaymentController@savePayment');
    Route::get('/outlet-id={outlet_id}/payment-history','OutletPaymentController@outletPaymentHistory');

    //Employee
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/new-employee', 'EmployeeController@newEmployee');
    Route::get('/edit-employee/{id}', 'EmployeeController@editEmployee');
    Route::post('/save-employee', 'EmployeeController@saveEmployee');
    Route::post('/update-employee/{id}','EmployeeController@updateEmployee');
    Route::get('/delete-employee/{id}','EmployeeController@deleteEmployee');

    //Charge
    Route::get('/charges', 'ChargeController@index');
    Route::get('/new-charge', 'ChargeController@newCharge');
    Route::get('/edit-charge/{id}', 'ChargeController@editCharge');
    Route::post('/save-charge', 'ChargeController@saveCharge');
    Route::get('/delete-charge/{id}','ChargeController@deleteCharge');

    //App setting
    Route::get('/app-setup','SettingController@appSetting');

    // Reports
    Route::get('/report/payment/outlet-id={outlet_id}/start={start_date}/end={end_date}/type={type}','ReportController@paymentReport');

});

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('outlet/id={outlet_id}')->group(function () {
    Route::middleware(['auth','active.user.only','valid.outlet.user'])->group(function (){

        Route::get('/web-site-setting','SettingController@webSetting');
        Route::post('/save-web-site-setting','SettingController@postWebSetting');

        Route::get('/dashboard', 'HomeController@outletDash');
        Route::get('/sell-charge','OutletController@sellCharge');
        Route::get('/sell-charge-payment','OutletController@outletPayment');
        Route::get('/profile','HomeController@profile');
        //Product category
        Route::get('/categories','CategoryController@index');
        Route::get('/new-category','CategoryController@newCategory');
        Route::get('/edit-category/{id}','CategoryController@editCategory');
        Route::get('/delete-category/{id}','CategoryController@deleteCategory');
        Route::post('/save-category','CategoryController@saveCategory');
        Route::post('/update-category/{id}','CategoryController@updateCategory');

        //Products
        Route::get('/products','ProductController@index');
        Route::get('/product/barcode','ProductController@barcode');
        Route::get('/new-product','ProductController@newProduct');
        Route::get('/edit-product/{id}','ProductController@editProduct');
        Route::post('/save-product','ProductController@saveProduct');
        Route::post('/update-product/{id}','ProductController@updateProduct');
        Route::get('/delete-product/{id}','ProductController@deleteProduct');

        //Sells man
        Route::get('/sells-men','EmployeeController@sellsMen');
        Route::get('/new-sells-man','EmployeeController@newSellsMan');
        Route::get('/edit-sells-man/{id}','EmployeeController@editSellsMan');
        Route::post('/save-sells-man','EmployeeController@saveSellsMan');
        Route::post('/update-sells-man/{id}','EmployeeController@updateSellsMan');
        Route::get('/delete-sells-man/{id}','EmployeeController@deleteSellsMan');

        //Reports
        Route::get('/sell-report/start={start_date}/end={end_date}/type={type}','ReportController@outletSellReport');
        Route::get('/payment-report/start={start_date}/end={end_date}/type={type}','ReportController@outletPaymentReport');

    });

    Route::middleware(['auth','valid.outlet.sells'])->group(function (){
        // POS
        Route::get('/pos','POSController@newSell');
        Route::post('/save-due-order','POSController@dueOrder');
        Route::get('/print/order={id}','POSController@printOrder');
        Route::get('/sells','POSController@sells');
    });


});
