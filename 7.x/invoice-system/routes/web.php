<?php

use App\Http\Controllers\InvoicesController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
Auth::routes();
//Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('invoices','InvoicesController') ;
Route::resource('sections','SectionsController');
Route::resource('products','ProductController');
Route::resource('invoiceAttachments','InvoiceAttachmentsController');
Route::get('/section/{id}','InvoicesController@getproducts')->name('section');
Route::get('/InvoicesDetails/{id}','InvoiceDetailsController@edit');
Route::get('View_file/{invoice_number}/{file_name}','InvoiceDetailsController@open_file');
Route::get('download/{invoice_number}/{file_name}','InvoiceDetailsController@get_file');
Route::post('delete_file','InvoiceDetailsController@destroy')->name('delete_file');
Route::get('/edit_invoice/{id}','InvoicesController@edit');
Route::get('/Status_show/{id}','InvoicesController@status_show')->name('Status_show');
Route::post('/Status_Update/{id}','InvoicesController@status_Update')->name('Status_Update');
Route::get('Invoices_Paid','InvoicesController@invoice_paid');
Route::get('Invoices_UnPaid','InvoicesController@invoice_UnPaid');
Route::get('Invoices_Partial','InvoicesController@invoice_Partial');
Route::get('Print_invoices/{id}','InvoicesController@print_invoice');
Route::resource('Archive','InvoiceAchiveController');
Route::get('/export_invoices', 'InvoicesController@export');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });

Route::get('/{page}', 'AdminController@index');
