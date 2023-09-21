<?php


namespace app\api\controller;

use app\Request;
use think\facade\Db;

/**
 * Class UserController
 * @package app\api\controller
 * @author 小范
 * @day 2023/9/19
 * 神兽保佑 永无bug
 */
class UserController
{
    public function user(Request $request)
    {
        $uid = $request->uid();
        $userInfo = Db::name('mood_user')->where('id', $uid)->where('status', 1)->find();
        return app('json')->success($userInfo);
    }
}