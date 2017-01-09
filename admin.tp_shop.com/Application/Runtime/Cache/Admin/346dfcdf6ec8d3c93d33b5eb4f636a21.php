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
        
<div class="page-heading">
    <h3>
        管理首页
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">管理后台</a>
        </li>
        <li> 商品管理 </li>
        <li class="active"> 新增商品</li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<section class="wrapper">
    <!-- page start-->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    新增商品
                </header>
                <div class="panel-body">
                    <form role="form" action="<?php echo U();?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品名称</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="请输入名字">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">货号</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" name="sn" placeholder="请输入货号">
                        </div>
                        <div>
                        <div class="form-group"  style="width: 50%; float: left">
                            <label for="exampleInputEmail1">商品分类</label>
                            <select class="form-control" name="goods_category_id">
                                <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value="<?php echo ($category["id"]); ?>" ><?php echo str_repeat('&emsp;',($category['level']-1)*2); echo ($category["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group"  style="width: 50%; float: right">
                            <label for="exampleInputEmail1">商品品牌</label>
                            <select class="form-control" name="brand_id">
                                <?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brand["id"]); ?>" ><?php echo ($brand["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        </div>
                        <div>
                            <div class="form-group" style="width: 25%; float: left">
                                <label >市场价</label>
                                <input type="text" class="form-control"  name="market_price" placeholder="请输入市场价">
                            </div>
                            <div class="form-group" style="width: 25%; float: left">
                                <label >本店价</label>
                                <input type="text" class="form-control"  name="shop_price" placeholder="请输入本店价">
                            </div>
                            <div class="form-group" style="width: 25%; float: left">
                                <label >库存</label>
                                <input type="text" class="form-control"  name="stock" placeholder="请输入库存">
                            </div>
                            <div class="form-group" style="width: 25%; float: left">
                                <label for="exampleInputEmail1">排序</label>
                                <input type="text" class="form-control" name="sort" placeholder="请输入排序数字,越小越靠前">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">参与活动:&emsp;</label>
                            <?php if(is_array($promotions)): $i = 0; $__LIST__ = $promotions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$promotion): $mod = ($i % 2 );++$i;?><input type="checkbox" name="prom_id[]" value="<?php echo ($promotion["id"]); ?>"><?php echo ($promotion["prom_type"]); ?>&emsp;&emsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品说明</label>
                            <textarea id="container" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="logo-upload">LOGO</label>
                            <input type="file" id="logo-upload">
                            <input type="hidden" name="logo" id="logo"/>
                            <img src="" id="logo-preview" style="max-width: 100px;max-height: 100px"/>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="radio" name="is_on_sale" value="1" checked /> 上架
                                <input type="radio" name="is_on_sale" value="0"  /> 下架
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">提交新增</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
</section>

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





    <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
    <script src="/Public/ext/layer/layer.js"></script>

    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    <script src="/Public/ext/uploadify/jquery.uploadify.min.js"></script>
    <script type='text/javascript'>
        $(function () {
            //初始化一个uploadify控件
            $("#logo-upload").uploadify({
                height: 30,
                swf: '/Public/ext/uploadify/uploadify.swf',
                uploader: '<?php echo U("Upload/upload");?>',
                width: 120,
                buttonText:'选择文件',
                fileTypeExts:'*.jpg;*.jpeg;*.jpe;*.png;*.gif',
                onUploadSuccess:function(file,data){
                    //将响应字符串转换为json对象
                    data = $.parseJSON(data);
                    if(data.status){
                        //成功了
                        $('#logo').val(data.url);
                        $('#logo-preview').attr('src',data.url);
                        layer.alert(data.msg, {icon: 6});
                    }else{
                        layer.alert(data.msg, {icon: 5});
                    }
                }
            });
        });
    </script>


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