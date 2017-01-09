<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="http://www.itsource.cn/upload/operationableFile/logo_small.jpg " />
		<title>源码时代</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="/Public/css/basic.css" rel="stylesheet" type="text/css">
		<link href="/Public/css/index.css" rel="stylesheet" type="text/css">
		<link href="/Public/css/unslider.css" rel="stylesheet" type="text/css">
		<link href="/Public/css/unslider-dots.css" rel="stylesheet" type="text/css">
		
		<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/Public/js/unslider-min.js"></script>
	</head>

	<body>
		<!-- header -->
		<div class="panel header">
			<a href="<?php echo U('Index/index');?>"><img class="logo" src="/Public/img/logo_2.png"></a>
			<div class="top_menu">
				<p class="at_login">
					<a href="<?php echo U('Index/index');?>">首页</a><span class="spliter">|</span>
					<a onclick="history.go(-1)">返回</a>
				</p>
				
					<div class="search_bar">
						<input class="search_bar-input" type="text" placeholder="查找你需要的茶叶" />
						<div style="position: relative; display: inline;">
							<ul class="auto_wrapper">
								<li>数据一</li>
								<li>数据二</li>
								<li>数据三</li>
								<li>数据四</li>
								<li>数据五</li>
							</ul>
						</div>
						<button class="search_bar-submit" type="search"><img src="/Public/img/syss.png">搜索</button>
						<button class="cart" type="button" onclick="javascript:window.location.href='<?php echo U('Cart/index');?>'"><img src="/Public/img/sygw.png">　购物车</button>
					</div>
				
				<?php if($_SESSION['userInfo'] == null): ?><p class="not_login">
							<a href="<?php echo U('User/login');?>">登录</a><span class="spliter">|</span>
							<a href="<?php echo U('User/register');?>">注册</a><span class="spliter"></span>
						</p>
					<?php else: ?>
						<p class="not_login">
							<?php echo session('userInfo.username');?><span class="spliter">|</span>
							<a href="<?php echo U('User/order');?>">用户中心</a><span class="spliter">|</span>
							<a href="<?php echo U('User/logout');?>">退出</a>
						</p><?php endif; ?>
				<p class="is_login"><span class="uname" name="uname">源码时代</span><span class="greetings">下午好~</span>
					<a href="">退出</a>
				</p>
			</div>
				<p class="menu">
					<a href="<?php echo U('Index/index');?>">首页</a><span class="spliter">|</span>
					<?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/product_list',['id'=>$category['id']]);?>"><?php echo ($category["name"]); ?></a><span class="spliter">|</span><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
		</div>
		
		<!-- center -->
		
	<div class="container center">
		<div class="panel">

			<!-- banner START -->
			<div class="banner">
				<ul>
					<li><a href="product.html"><img src="/Public/img/index/banner1.png" /></a></li>
					<li><a href="product.html"><img src="/Public/img/index/banner2.png" /></a></li>
					<li><a href="product.html"><img src="/Public/img/index/banner3.png" /></a></li>
					<li><a href="product.html"><img src="/Public/img/index/banner4.png" /></a></li>
				</ul>
			</div>
			<!-- banner END -->
			<!-- "新品上市" START -->
			<div class="new_product">
				<p class="title"><img src="/Public/img/index/sfbt1.png"></p>
				<div class="flex-list-box">
					<dl class="products-list">
						<?php if(is_array($goods)): $i = 0; $__LIST__ = array_slice($goods,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/product',['id'=>$good['id']]);?>">
								<dd>
									<p><img src="<?php echo ($good["logo"]); ?>"></p>
									<p class="paid">库存:<?php echo ($good["stock"]); ?></p>
									<p class="price">¥：<?php echo ($good["shop_price"]); ?></p>
									<p><?php echo ($good["name"]); ?></p>
								</dd>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
				</div>
			</div>
			<!-- "新品上市" END -->
			<!-- "所有商品" START -->
			<div class="all_product">
				<p class="title"><img src="/Public/img/index/sfbt2.png"></p>
				<div class="flex-list-box">
					<dl class="products-list">
						<?php if(is_array($goods)): $i = 0; $__LIST__ = array_slice($goods,0,12,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/product',['id'=>$good['id']]);?>">
								<dd>
									<p><img src="<?php echo ($good["logo"]); ?>"></p>
									<p class="paid">库存:<?php echo ($good["stock"]); ?></p>
									<p class="price">¥：<?php echo ($good["shop_price"]); ?></p>
									<p><?php echo ($good["name"]); ?></p>
								</dd>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
				</div>
			</div>
			<!-- "所有商品" END -->
			<!-- "get小技能" START -->
			<div class="tcommon">
				<p class="title"><img src="/Public/img/index/sybt3.png"></p>
				<div class="flex-list-box">
					<dl class="products-list">
						<?php if(is_array($articleCategories)): $i = 0; $__LIST__ = array_slice($articleCategories,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articleCategory): $mod = ($i % 2 );++$i;?><dd>
								<p class="title2"><?php echo ($articleCategory["category_name"]); ?></p>
								<?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i; if($articleCategory['category_id'] == $article['article_category_id']): ?><ul>
											<a href="<?php echo U('Index/article',['id'=>$article['id']]);?>">
												<li><?php echo ($article["name"]); ?></li>
											</a>
										</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
				</div>
			</div>
			<!-- "get小技能" END -->
			<!-- "多快好省" START -->
			<div class="VFGC">
				<p class="title"></p>
				<div class="flex-list-box">
					<dl>
						<dd>
							<img src="/Public/img/index/syfw1.png">
						</dd>
						<dd>
							<img src="/Public/img/index/syfw2.png">
						</dd>
						<dd>
							<img src="/Public/img/index/syfw3.png">
						</dd>
						<dd>
							<img src="/Public/img/index/syfw4.png">
						</dd>
					</dl>
				</div>
			</div>
			<!-- "多快好省" END -->
		</div>
	</div>

		<!-- footer -->
		<div class="container footer">
			<div class="panel cfooter">
				<div class="f_top">
					<div class="t_left">
						<p>源码时代商城-出售源码时代周边产品，学习资料</p>
						<p>地&emsp;&emsp;址：&emsp;成都市高新区府城大道西段399号天府新谷1号楼6F</p>
						<p>电&emsp;&emsp;话：&emsp;028-86261949</p>
						<p>邮&emsp;&emsp;箱：&emsp;yuandaima@itsource.cn</p>
						<p>2006-2016成都源代码教育咨询有限公司 版权所有</p>
						<p>
							<a href="http://www.miitbeian.gov.cn" target="_blank">蜀ICP备14030149号-1</a>
						</p>
					</div>
					<div class="t_right">
						<div class="footer_right_wx">
							<img alt="源码时代" src="/Public/img/new3/weixin.png">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/Public/js/basic.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".center .banner").unslider({
				animation: 'fade',
				autoplay: true,
				arrows: false
			});
		});
	</script>
	
</html>