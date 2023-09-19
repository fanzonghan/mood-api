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
    public function index()
    {

        $banner = [
            [
                'image' => 'http://pan.xiaofan.ink/down/banner.jpg',
                'title' => '让生活多一些艺术，让日子变得更加精致',
                'url' => '',
            ]
        ];
        $affiche = [
            'title' => '注意：这是一条公告',
            'url' => '#',
        ];
        return app('json')->success(compact('banner', 'affiche'));
    }
}