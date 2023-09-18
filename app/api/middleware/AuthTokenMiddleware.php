<?php


namespace app\api\middleware;

use app\Request;
use xiaofan\utils\JwtAuth;

class AuthTokenMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $token = trim(ltrim($request->header('Authori-zation'), 'Bearer'));
        if (!$token) $token = trim(ltrim($request->header('Authorization'), 'Bearer'));//正式版，删除此行，某些服务器无法获取到token调整为 Authori-zation
        try {
            // token 合法
            /** @var JwtAuth $Jwtauth */
            $Jwtauth = app()->make(JwtAuth::class);
            $tokenData = $Jwtauth->checkToken($token);
            $authInfo = $tokenData['data'];
            Request::macro('uid', function () use (&$authInfo) {
                return is_null($authInfo) ? 0 : (int)$authInfo['user']->uid;
            });
            Request::macro('userInfo', function () use (&$authInfo) {
                return $authInfo['data'];
            });
            Request::macro('tokenData', function () use (&$authInfo) {
                return $authInfo;
            });
        } catch (\Exception $e) {
            return app('json')->make($e->getCode(), $e->getMessage());
        }

        return $next($request);
    }
}