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
		
	<link href="/Public/css/ucart.css" rel="stylesheet" type="text/css">

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
		
	<!-- center -->
	<div class="container center">
		<div class="panel">

			<p class="title">我的购物车</p>
			<table class="cargo">
				<thead>
				<tr>
					<td colspan="2"><input type="checkbox" />全部</td>
					<td>商品信息</td>
					<td>单价</td>
					<td>数量</td>
					<td>小计</td>
					<td>操作</td>
				</tr>
				</thead>
				<tbody>
				<?php if(is_array($goodsLists)): $i = 0; $__LIST__ = $goodsLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsList): $mod = ($i % 2 );++$i;?><tr>
						<td><input type="checkbox" /></td>
						<td><img src="<?php echo ($goodsList["logo"]); ?>" /></td>
						<td><?php echo ($goodsList["name"]); ?></td>
						<td>￥：<?php echo ($goodsList["shop_price"]); ?></td>
						<td>
							<button class="decrease">-</button>
							<input class="amount" type="text" value="<?php echo ($goodsList["amount"]); ?>"/>
							<button class="increase">+</button>
						</td>
						<td>￥：<?php echo ($goodsList["sub_total"]); ?></td>
						<td><span class="delete">×</span></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="4"><input type="checkbox" />全选　<a href="">删除</a></td>
					<td>共计 <span class="count"><?php echo ($total_number); ?></span> 件商品</td>
					<td colspan="2">合计（不含运费）：<span class="sum">￥<?php echo ($total_price); ?></span>　
						<a href="<?php echo U('Order/create');?>"><button class="submit">结算</button></a>
					</td>
				</tr>
				</tfoot>
			</table>
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
	
	<script type="text/javascript">
		$(".center .cargo .decrease, .center .cargo .increase").addClass("button_color_scheme_dark");
		$(".center .cargo .submit").addClass("button_color_scheme_dark borderRadius_scheme_small");

		$(function(){
			$(".center .cargo .delete").live({
				click: function(){
					$(this).parent().parent().remove();
				},
				hover: function(){
					$(this).css({"cursor":"pointer"});
				}
			})
		});
	</script>

</html>