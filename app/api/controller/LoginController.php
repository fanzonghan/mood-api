<?php

namespace app\api\controller;

use think\facade\Db;
use think\Request;
use xiaofan\utils\JwtAuth;

class LoginController
{
    public function login(Request $request)
    {
        $account = $request->post('account', '');
        $password = $request->post('password', '');
        if (empty($account) || empty($password)) {
            return app('json')->fail("账号密码不能为空");
        }
        $userInfo = Db::name('mood_user')->where('account', $account)->where('status', 1)->find();
        if (!$userInfo) {
            return app('json')->fail("账号不存在");
        }
        if ($userInfo['pwd'] == md5($password)) {
            $token = JwtAuth::signToken($userInfo);
            return app('json')->success(compact('userInfo', 'token'));
        }
        return app('json')->fail('账号或密码错误');
    }

    public function register(Request $request)
    {
        $account = $request->post('account', '');
        $password = $request->post('password', '');
        $data = [
            'account' => $account,
            'pwd' => md5($password),
            'nickname' => '用户' . mb_substr($account, 5),
            'avatar' => '',
            'phone' => $account,
            'add_time' => time(),
            'add_ip' => $request->ip(),
        ];
        $res = Db::name('mood_user')->insert($data);
        if (!$res) return app('json')->fail('注册失败');
        return app('json')->success('注册成功');
    }
}
