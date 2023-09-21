<?php


namespace app\api\route;

use app\api\middleware\AuthTokenMiddleware;
use think\facade\Route;
use think\facade\Config;
use think\Response;

//登录
Route::post('login', 'LoginController/login');
Route::post('register', 'LoginController/register');
Route::get('index', 'PublicController/index');
Route::get('article/list', 'PublicController/article_list');

//会员授权接口
Route::group(function () {
    //个人中心
    Route::get('user', 'UserController/user');
    //图片上传
    Route::post('upload', 'Upload/uploads');
    //发布文章
    Route::post('article/add', 'ArticleController/add');
    //我的文章
    Route::get('my_article/list', 'ArticleController/my_article_list');
})->middleware(AuthTokenMiddleware::class);

Route::miss(function () {
    if (app()->request->isOptions()) {
        $header = Config::get('cookie.header');
        unset($header['Access-Control-Allow-Credentials']);
        return Response::create('ok')->code(200)->header($header);
    } else
        return Response::create()->code(404);
});
