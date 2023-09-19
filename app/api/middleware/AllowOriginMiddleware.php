<?php


namespace app\api\middleware;

use app\Request;
use think\facade\Config;
use think\facade\Log;
use think\Response;

/**
 * Class AllowOriginMiddleware
 * @package app\api\middleware
 * @author 小范
 * @day 2023/9/18
 * 神兽保佑 永无bug
 */
class AllowOriginMiddleware
{

    /**
     * 允许跨域的域名
     * @var string
     */
    protected $cookieDomain;

    /**
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, \Closure $next)
    {
        $this->cookieDomain = Config::get('cookie.domain', '');
        $header = Config::get('cookie.header');
        $origin = $request->header('origin');
        if ($origin && ('' == $this->cookieDomain || strpos($origin, $this->cookieDomain)))
            $header['Access-Control-Allow-Origin'] = $origin;
        if ($request->method(true) == 'OPTIONS') {
            $response = Response::create('ok')->code(200)->header($header);
        } else {
            $response = $next($request)->header($header);
        }
        return $response;
    }
}