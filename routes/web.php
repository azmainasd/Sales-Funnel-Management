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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register'=>false]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'admin\HomeController@index')->name('admin.home');
// Route::get('/', function(){
//     return redirect(route('login'));
// });

Route::resource('dashboard', 'admin\DashboardController');
Route::get('get-local-secured-leads', 'admin\DashboardController@getLocalSecuredLeads');
Route::get('get-foreign-secured-leads', 'admin\DashboardController@getForeignSecuredLeads');
Route::get('get-local-deleted-leads', 'admin\DashboardController@getLocalDeletedLeads');
Route::get('get-foreign-deleted-leads', 'admin\DashboardController@getForeignDeletedLeads');
Route::get('lead-details/{id}', 'admin\DashboardController@leadDetails')->name('lead.details');
Route::get('secured-lead-details/{id}', 'admin\DashboardController@securedLeadDetails');
Route::get('deleted-lead-details/{id}', 'admin\DashboardController@deletedLeadDetails');
Route::get('local-leads-date-filter/{startDate}/{endDate}', 'admin\DashboardController@filterLocalLeadsByDate');
Route::get('foreign-leads-date-filter/{dateStart}/{dateEnd}', 'admin\DashboardController@filterForeignLeadsByDate');

Route::resource('solution', 'admin\SolutionController');

Route::resource('industry', 'admin\IndustryController');

Route::resource('client', 'admin\ClientController');

Route::resource('owner', 'admin\OwnerController');

Route::resource('partner', 'admin\PartnerController');

Route::resource('sales-funnel', 'admin\SalesFunnelController');

Route::resource('secure-project', 'admin\SecureProjectController');

Route::resource('delete-project', 'admin\DeleteProjectController');

Route::resource('user', 'admin\UserController');

Route::resource('role', 'admin\RoleController');
