<?php

namespace app\api\controller;

use think\Request;

class Login
{
    public function login(Request $request){
        return app('json')->success('success');
    }
}
