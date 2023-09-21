<?php


namespace app\api\controller;

use app\Request;
use think\facade\Db;
use think\facade\Log;

/**
 * Class ArticleController
 * @package app\api\controller
 * @author 小范
 * @day 2023/9/20
 * 神兽保佑 永无bug
 */
class ArticleController
{
    public function add(Request $request)
    {
        $hotel = $request->post('hotel', '');
        $img = $request->post('img', '');
        $intro = $request->post('intro', '');
        $mood = $request->post('mood', '');
        $visible = $request->post('visible', 1);//1私密 2公开
        $uid = $request->uid();
        $data = [
            'uid' => $uid,
            'mood' => $mood,
            'visible' => $visible,
            'content' => $intro,
            'add_time' => strtotime($hotel),
        ];
        Db::startTrans();
        try {
            $res = Db::name('mood_article')->insertGetId($data);
            if (!$res) throw new \Exception("发布失败");
            $imgArr = explode(',', $img);
            $imgDate = [];
            foreach ($imgArr as &$image) {
                $imgDate[] = [
                    'aid' => $res,
                    'img' => $image
                ];
            }
            $res = Db::name('mood_article_img')->insertAll($imgDate);
            if (!$res) throw new \Exception("图片发布失败");
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            return app('json')->fail($e->getMessage());
        }
        return app('json')->success("发布成功");

    }

    //首页文章列表
    public function my_article_list(Request $request)
    {
        $page = $request->get('page', 1);
        $where = [
            ['status', '=', 1],
            ['uid', '=', $request->uid()],
        ];
        $list = Db::name('mood_article')->where($where)->order('add_time desc')->limit($page, 5)->select();
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