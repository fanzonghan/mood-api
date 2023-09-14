<?php

namespace app\api\controller;

use think\Request;

class Login
{
    public function test(){
        return app('json')->success('aaa');
    }
}
