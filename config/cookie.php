<?php
// +----------------------------------------------------------------------
// | Cookie设置
// +----------------------------------------------------------------------
return [
    // cookie 保存时间
    'expire' => 0,
    // cookie 保存路径
    'path' => '/',
    // cookie 有效域名
    'domain' => '',
    // cookie 启用安全传输
    'secure' => false,
    // httponly设置
    'httponly' => false,
    // 是否使用 setcookie
    'setcookie' => true,
    // 跨域header
    'header' => [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => 'Authorization, Content-Type, Form-Type, Authori-zation',
        'Access-Control-Allow-Methods' => 'GET,POST,PATCH,PUT,DELETE,OPTIONS,DELETE',
        'Access-Control-Max-Age' => '1728000',
        'Access-Control-Allow-Credentials' => 'true'
    ],
    // token名称
    'token_name' => 'Authori-zation',
];
