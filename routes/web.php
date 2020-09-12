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

Route::post('/images', function () {
    return response()->json([
        "items" => [
            0 => [
                "creation_name" => "pogba",
                "creation_url" => "https://imgresizer.eurosport.com/unsafe/1200x0/filters:format(jpeg):focal(1469x265:1471x263)/origin-imgresizer.eurosport.com/2020/08/27/2872742-59162848-2560-1440.jpg",
                "creation_social" => [
                    "likes" => 12,
                    "dislikes" => 3
                ],
            ],
            1 => [
                "creation_name" => "lpb",
                "creation_url" => "data:image/jpeg;base64,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",
                "creation_social" => [
                    "likes" => 666,
                    "dislikes" => -666
                ],
            ]
        ]
    ]);
});
