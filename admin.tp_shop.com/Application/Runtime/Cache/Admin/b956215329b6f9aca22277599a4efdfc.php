<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <!--<link rel="shortcut icon" href="#" type="image/png">-->

  <title>AdminX</title>

  <!--common-->
  <link href="/Public/css/style.css" rel="stylesheet">
  <link href="/Public/css/style-responsive.css" rel="stylesheet">
  <link href="/Public/ext/uploadify/common.css" rel="stylesheet">

    
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/Public/js/html5shiv.js"></script>
  <script src="/Public/js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="<?php echo U('Index/index');?>"><span>管理首页</span></a></li>
                <?php if(is_array($nav_menus)): foreach($nav_menus as $key=>$top_nav): if(($top_nav["level"]) == "1"): ?><li class="menu-list"><a href=""> <span><?php echo ($top_nav["name"]); ?></span></a>
                            <ul class="sub-menu-list">
                                <?php if(is_array($nav_menus)): foreach($nav_menus as $key=>$sub_nav): if(($sub_nav["parent_id"]) == $top_nav["id"]): ?><li><a href="<?php echo U($sub_nav['path']);?>"> <?php echo ($sub_nav["name"]); ?></a></li><?php endif; endforeach; endif; ?>
                            </ul>
                        </li><?php endif; endforeach; endif; ?>
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="搜索" />
            </form>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="/Public/images/photos/user-avatar.png" alt="" />
                            <?php echo session('admin.username');?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  个人资料</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  修改密码</a></li>
                            <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        <!-- page heading start-->
        

    <!-- page heading start-->
    <div class="page-heading">
        <h3>
            管理首页
        </h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">管理后台</a>
            </li>
            <li class="active"> 菜单管理 </li>
        </ul>
    </div>
    <!-- page heading end-->

    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        菜单列表
                            <span class="tools pull-right">
                                <a href="<?php echo U('add');?>" class="btn btn-success btn-link">新增</a>
                            </span>
                    </header>
                    <div class="panel-body">
                        <hr/>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>菜单名称</th>
                                    <th>路径</th>
                                    <th>菜单简介</th>
                                    <th class="hidden-phone">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="gradeX">
                                        <td><?php echo str_repeat('&emsp;',($list['level']-1)*2); echo ($list["name"]); ?></td>
                                        <td><?php echo ($list["path"]); ?></td>
                                        <td><?php echo (substr($list["intro"],0,25)); ?>......</td>
                                        <td>
                                            <a href="<?php echo U('edit', array('id' => $list['id']));?>" class="btn btn-xs btn-success">编辑</a>
                                            <a href="<?php echo U('delete', array('id' => $list['id']));?>" class="btn btn-danger btn-xs deleteBtn">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <?php echo ($pages); ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示：Notice!</h4>
                </div>
                <div class="modal-body">
                    亲！你确认要删除吗？删除了没有办法恢复哟~么么哒！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">好的，我不删除了</button>
                    <a href="" id="deleteTrue" class="btn btn-primary">滚！狠心删除</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('.deleteBtn').click(function(){
                var _link = $(this).attr('data-href');
                $('#deleteTrue').attr('href', _link);
            })
        });
    </script>

        <!-- page heading end-->
        <!-- 验证码
        <form action="<?php echo U('checkVerify');?>" method="get"><br>
            <input type="text" name="checkVerify"><br>
            <img src="<?php echo U('verify');?>" height="40" onclick="randImg(event)"><br>
            <button type="submit">ok</button>
        </form>-->


        <!--footer section start-->
        <footer>
            2014 &copy; AdminEx by ThemeBucket
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/Public/js/bootstrap.min.js"></script>
<script src="/Public/js/jquery.nicescroll.js"></script>



</body>
<!--common scripts for all pages-->
<script src="/Public/js/scripts.js"></script>
<!--<script>
    function randImg(e){
        var _imgUrl = "<?php echo U('verify');?>";
        _imgUrl += '?c=' + Math.random();
        e = e || event;
        e.target.src = _imgUrl;
    }
</script>-->
</body>
</html>