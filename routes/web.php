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

Route::get('/', function () {
    return view('welcome');
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

    DB::table('data_profile')->where('license', request()->input('license'))->update([
            'license' => request()->input('license'),
            'name' => $name->text,
            'phone' => $phone->text,
            'speciality' => '',
            'address' => $address->text,
            'content' => request()->input('list')
        ]);
    return ['success'];
});
