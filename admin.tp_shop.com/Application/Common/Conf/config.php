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

    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
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
        '__IMG__'       => '/Public/images',
        '__FONTS__'     => '/Public/fonts',
        '__UPLOADIFY__' => '/Public/ext/uploadify',
        '__LAYER__' => '/Public/ext/layer',
        '__ZTREE__'   => '/Public/ext/ztree',
    ],
    //配置上传文件需要的配置以及使用cdn的配置信息
    'UPLOAD_SETTING'    => [
        'URL_PREFIX' => 'http://admin.shop.com/',

        'SETTING'    => array(
            'mimes'        => array('image/jpeg', 'image/png', 'image/gif'), //允许上传的文件MiMe类型
            'maxSize'      => 0, //上传的文件大小限制 (0-不做限制)
            'exts'         => array('jpg', 'png', 'gif', 'jpeg', 'jpe'), //允许上传的文件后缀
            'autoSub'      => true, //自动子目录保存文件
            'subName'      => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'     => './', //保存根路径
            'savePath'     => 'Uploads/', //保存路径
            'saveName'     => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'      => '', //文件保存后缀，空则使用原后缀
            'replace'      => false, //存在同名是否覆盖
            'hash'         => true, //是否生成hash编码
            'callback'     => false, //检测文件是否存在回调，如果存在返回文件信息数组

            //使用七牛云提供的CDN
            'driver'       => 'Qiniu', // 文件上传驱动
            'driverConfig' => array(
                'secretKey' => 'w_2WMZHoPurkst2GyC7-L0UkIOLF14H47oVb3jc1', //七牛密码
                'accessKey' => '5SgMrELjGgKL6LjXh-WtI-W2vWt3nhSug5Ks3QCR', //七牛用户
                'domain'    => 'oieqou5b6.bkt.clouddn.com', //七牛服务器
                'bucket'    => 'tp-shop', //空间名称
                'timeout'   => 300, //超时时间
            ), // 上传驱动配置
        ),
    ],

    'NOT_CHECK' => [
        'ANY' => [
            'Admin/Login/login',
            'Admin/Login/check',
            'Admin/Login/verify',
        ],
        'USER' => [
            'Admin/Admin/index',
            'Admin/Login/logout',
            'Admin/Menu/getUserMeunList',
        ],
    ],
);