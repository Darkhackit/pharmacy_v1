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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('pay/{id}', 'HomeController@pay')->name('pay');
    Route::get('account', 'HomeController@account')->name('account');
    Route::get('getLowStock', 'HomeController@getLowStock')->name('lowStock');
    Route::get('owing', 'HomeController@purchaseOwing')->name('owing');
    Route::patch('account/update/{id}', 'HomeController@updateaccount')->name('account.update');
    Route::patch('password/update/{id}', 'HomeController@passwordupdate')->name('account.password');
    Route::resource('user', 'UserController');
    Route::get('/getdatas/gettes', 'UserController@salPerson')->name('saPerson');
    Route::post('/getdatas/gettes','UserController@fetchUserSales')->name('filterPerson');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    Route::resource('supply', 'SupplierController');
    Route::resource('customer', 'CustomerController');
    Route::get('customer/viewPurchase/{id}', 'CustomerController@fetchPurchases')->name('view.purchase');
    Route::resource('manufacture', 'ManufacturerController');
    Route::resource('category', 'CategoryController');
    Route::resource('type', 'TypeController');
    Route::resource('unit', 'UnitController');
    Route::resource('medicine', 'MedicineController');
    Route::resource('payment', 'PaymentController');
    Route::resource('expensecategory', 'PaymentCategoryController');
    Route::get('expense/report', 'ExpenseController@report')->name('expense.report');
    Route::resource('expense', 'ExpenseController');
    Route::get('med/report', 'MedicineController@reportMedicine')->name('med.report');
    Route::get('med/stock', 'MedicineController@checkStock')->name('med.stock');
    Route::resource('sales', 'SalesController');
    Route::get('profoma/invoice', 'SalesController@profoma')->name('profoma.invoice');
    Route::get('whole/sales', 'SalesController@wholesales')->name('sales.wholesale');
    Route::get('filter/sales','SalesController@getAllSales')->name('sales.filter');
    Route::post('filter/sales','SalesController@fetchSales')->name('sales.fetch_data');
    Route::get('return/sales', 'SalesController@returnsales')->name('sales.return');
    Route::get('returned/sales/{code}', 'SalesController@returnsalesCode');
    Route::post('returned/store', 'SalesController@returnStore')->name('returned.store');
    Route::get('returned/reason/{id}', 'SalesController@returnReason')->name('returned.reason');
    Route::delete('returned/reason/{id}', 'SalesController@returnDelete')->name('returned.delete');
    Route::get('returned/list', 'SalesController@returnList')->name('return.list');
    Route::post('range', 'SalesController@range')->name('sales.range');
    Route::get('report', 'SalesController@report')->name('sales.report');
    Route::get('getCurrentSales', 'SalesController@getCurrentSales')->name('getCurrentSales');
    Route::post('createpdf','SalesController@createpdf')->name('sales.pdf');
    Route::get('stock', 'MedicineController@stock')->name('medicine.stock');
    Route::get('expiration', 'MedicineController@expire')->name('medicine.expire');
    Route::get('prescription', 'MedicineController@prescription')->name('medicine.prescription');
    Route::patch('stock/update/{id}', 'MedicineController@updatestock')->name('medicine.stockUpdate');
    Route::get('trash/supply','SupplierController@trashe')->name('trash.supply');
    Route::get('trash/manufacture','ManufacturerController@trashe')->name('trash.manu');
    Route::get('sal/values', 'SalesController@salesValue')->name('salesValue');
    Route::get('trash/customer','CustomerController@trashe')->name('trash.customer');
    Route::get('restore/customer/{id}', 'CustomerController@restore')->name('supply.restore');
    Route::get('restore/manufacture/{id}', 'ManufacturerController@restore')->name('manufacture.restore');
    Route::get('restore/supply/{id}', 'SupplierController@restore')->name('supply.restore');
    Route::resource('shops', 'ShopController');
    Route::get('transfers', 'TransferController@index')->name('transfer.index');
    Route::get('transfers/create', 'TransferController@create')->name('transfer.create');
    Route::post('transfers/store', 'TransferController@store')->name('transfer.store');
    Route::get('transfers/store/{id}', 'TransferController@show')->name('transfer.show');

    Route::get('site/shutdown', function(){
        return Artisan::call('down');
    })->name('cutOff');
    Route::resource('settings', 'SettingsController');
    Route::resource('purchase', 'PurchaseController');
    Route::get('filter/purchase','PurchaseController@getAllPurchase')->name('purchase.filter');
    Route::post('data/purchase','PurchaseController@fetchData')->name('purchase.fetch_data');
    Route::get('purchases/return','PurchaseController@purchaseReturn')->name('purchases.return');
    Route::get('returned/purchase/{id}','PurchaseController@purchasedRetur');
    Route::resource('wastage', 'WastageController');
    Route::resource('wastage_type', 'WastageTypeController');
    Route::get('purchase/details/{id}', 'PurchaseController@purchaseDetails');
    Route::post('resetstock','MedicineController@resetstock');
    Route::post('updatestockValue','MedicineController@updatestockValue');
    Route::get('customers/purchases','CustomerController@purchaseCustomer')->name('customer.purchase');
    Route::post('customers/purchases','CustomerController@purchaseCustomersubmit')->name('customer.purchased');
    Route::post('customers/pdf','CustomerController@customerPdf')->name('customer.pdf');
    Route::get('medicine/hidden/{id}','MedicineController@hidden');
    Route::get('medicine/check_name/{name}','MedicineController@check_name');

    Route::get('report/sales','ReportController@sales')->name('report.sales');





});


