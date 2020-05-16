<?php

use Illuminate\Support\Facades\DB;
use PHPHtmlParser\Dom;

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
// Route::get('/', 'HomeController@index')->name('home');
Route::get("/","DataProfileController@index")->name('upload');
Route::post("upload","DataProfileController@store")->name('upload');

Route::get('/listing/{reset?}', function () {
    $reset = request()->input('reset');

    if ($reset) {
        DB::table('data_profiles')->whereNotNull('in_progress')->update(['in_progress', null]);
    }

    $listing = DB::table('data_profiles')->whereNull('in_progress')->whereNull('content')->take('500')->get();
    DB::table('data_profiles')->whereIn('license', $listing->pluck('license')->toArray())->update(['in_progress' => now()->toDateTimeString()]);

    return json_encode($listing->pluck('license')->toArray());
});

Route::post('list', function () {
    DB::table('data_list')->insert([
        [
            'license' => request()->input('license'),
            'content' => request()->input('list')
        ]
    ]);
    return ['success'];
});

Route::post('profile', function () {
    $profileData = json_decode(request()->input('list'), true);
    $dom = new Dom;
    $dom->load($profileData['profile']);
    $name = $dom->find('#lbl_name')[0];
    $phone = $dom->find('#lbl_phone')[0];
    $speciality = '';
    $address = $dom->find('#lbl_add')[0];

    DB::table('data_profiles')->where('license', request()->input('license'))->update([
            'license' => request()->input('license'),
            'name' => $name->text,
            'phone' => $phone->text,
            'speciality' => '',
            'address' => $address->text,
            'content' => request()->input('list'),
            'in_progress' => null
        ]);
    return ['success'];
});
