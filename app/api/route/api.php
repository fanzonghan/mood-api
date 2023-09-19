<?php


namespace app\api\route;

use think\facade\Route;
use think\facade\Config;
use think\Response;

//登录
Route::post('login', 'Login/login');

Route::get('index', 'PublicController/index');

Route::post('upload', 'Upload/uploads');
Route::post('article/add', 'Login/test');

Route::miss(function () {
    if (app()->request->isOptions()) {
        $header = Config::get('cookie.header');
        unset($header['Access-Control-Allow-Credentials']);
        return Response::create('ok')->code(200)->header($header);
    } else
        return Response::create()->code(404);
});
