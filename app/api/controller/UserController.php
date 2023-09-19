<?php


namespace app\api\controller;

/**
 * Class UserController
 * @package app\api\controller
 * @author 小范
 * @day 2023/9/19
 * 神兽保佑 永无bug
 */
class UserController
{
    public function user()
    {
        $userInfo = [
            'id' => 1,
            'account' => 'test',
            'nickname' => '测试',
            'phone' => '188888888888',
            'avatar' => 'http://test.h5.org.cn/qz/pet/images/mine/d-icon1.png',
        ];
        return app('json')->success($userInfo);
    }
}