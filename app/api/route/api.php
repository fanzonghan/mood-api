<?php


namespace app\api\route;

use app\api\middleware\AllowOriginMiddleware;
use think\facade\Route;

Route::group(function () {
    
    Route::get('test', 'Login/test');
    Route::post('upload', 'Upload/uploads');
    Route::post('article/add', 'Login/test');

})->middleware(AllowOriginMiddleware::class);
