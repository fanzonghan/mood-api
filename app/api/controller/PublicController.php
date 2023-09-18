<?php


namespace app\api\controller;

/**
 * Class PulicController
 * @package app\api\controller
 * @author 小范
 * @day 2023/9/18
 * 神兽保佑 永无bug
 */
class PublicController
{
    public function index(){
        return app('json')->success('afa');
    }
}