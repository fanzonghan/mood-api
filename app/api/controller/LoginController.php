<?php

namespace app\api\controller;

use think\Request;
use xiaofan\utils\JwtAuth;

class LoginController
{
    public function login(Request $request)
    {
        $userInfo = [
            'id' => 1,
            'account' => 'test',
            'nickname' => '',
            'phone' => '',
            'avatar' => '',
        ];
        $token = JwtAuth::signToken($userInfo);
//        return app('json')->fail('账号或密码错误');
        return app('json')->success(compact('userInfo','token'));
    }
}
