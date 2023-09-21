<?php


namespace app\api\controller;

use app\Request;
use think\facade\Db;
use think\facade\Log;

/**
 * Class PulicController
 * @package app\api\controller
 * @author 小范
 * @day 2023/9/18
 * 神兽保佑 永无bug
 */
class PublicController
{
    //
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

    //首页文章列表
    public function article_list(Request $request)
    {
        $type = $request->get('type', 0);
        $page = $request->get('page', 1);
        $where = [
            ['status', '=', 1],
            ['visible', '=', 2],
        ];
        switch ($type) {
            case 0://推荐
                $list = Db::name('mood_article')->where($where)->order('add_time desc')->limit($page, 5)->select();
                break;
            case 1://最新
                //            $list = Db::name('mood_article')->where('status', 1)->orderRaw("rand()")->limit(5)->select();
                $list = Db::name('mood_article')->where($where)->order('add_time desc')->limit($page, 5)->select();
                break;
        }
        if (!empty($list)) {
            $list = $list->toArray();
            foreach ($list as &$item) {
                $item['add_time'] = date('Y-m-d H:i', $item['add_time']);
                $item['img_list'] = Db::name('mood_article_img')->where('aid', $item['id'])->where('status', 1)->column('img');
                $userInfo = Db::name('mood_user')->where('status', 1)->where('id', $item['uid'])->find();
                $item['nickname'] = $userInfo['nickname'];
                $item['headimgurl'] = $userInfo['avatar'];
                $item['need_pd'] = [[
                    "item_id" => 1621,
                    "item_name" => "原创"
                ]];
                $item['showText'] = false;//展开or收起
            }
        }
        $count = count($list);
        return app('json')->success(compact('list', 'count'));
    }

}