<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'tp_shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存,上线时改成true
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    //开启trace
    'SHOW_PAGE_TRACE' => true,

    //定义特殊字符串
    'TMPL_PARSE_STRING' => [
        '__CSS__'       => '/Public/css',
        '__JS__'        => '/Public/js',
        '__IMG__'       => '/Public/img',
        '__FONTS__'     => '/Public/fonts',
        '__UPLOADIFY__' => '/Public/ext/uploadify',
        '__LAYER__' => '/Public/ext/layer',
        '__ZTREE__'   => '/Public/ext/ztree',
    ],
    //分页配置
    'PAGE'              => [
        'SIZE'  => 1,
        'THEME' => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%'
    ],
    //邮箱激活配置
    'MAILER' =>[
        'Host' => 'smtp.qq.com',
        'Username' => 'gmfs@qq.com',
        'Password' => 'vddxermclyerbjgi',
        'SMTPSecure' => 'ssl',
        'Port' => 465
    ],
    //短信验证配置
    'SMS_SENDER' => [
        'AK' => '23585925',
        'SK' => 'a176bb78c52adfdb8beedb25fa616814',
        'SIGN' => '测试',
        'TEMPLATE' => 'SMS_36380112',
    ],
    //需要登录验证的页面
    'CHECK' => [
        'Home/Order/create',
    ],

    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
         // 定义格式1 数组方式
         'Index:article'    =>     array('article/{:action}_{id}', 300),
         // 定义格式2 字符串方式
        ),
);