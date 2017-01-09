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
		
	<link href="/Public/css/product.css" rel="stylesheet" type="text/css">
	<link href="/Public/css/lightslider.css" rel="stylesheet" type="text/css">

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
			<p class="uposition">你的当前位置：<a href="index.html">首页</a><span class="spliter">></span><a href="index.html#new_product">新品上市</a><span class="spliter">></span><a href=""><?php echo ($goods["name"]); ?></a></p>
			<div class="description">
				<p class="title" style="padding-right: 450px"><?php echo ($goods["name"]); ?></p>
				<p class="subtitle"><?php echo ($goods["name"]); ?></p>

				<form action="<?php echo U('Cart/addCart');?>" method="post">
					<dl>
						<dt>价格</dt>
						<dd class="price">￥<?php echo ($goods["market_price"]); ?></dd>
						<dt>促销价</dt>
						<dd class="promotional_price">￥<?php echo ($goods["shop_price"]); ?></dd>
						<dt>月销量</dt>
						<dd class="sales">106</dd>
						<dt>累计评价</dt>
						<dd class="comment">3461</dd>
						<dt>运费</dt>
						<dd class="freight">福建武夷山市至<select><option>成都</option></select></span> 快递：0.00</dd>
						<dt>服务</dt>
						<dd class="deliver">由京东发货，并提供售后服务。</dd>
						<dt>数量</dt>
						<dd class="amount"><button class="decrease">-</button>
							<input type="text" name="amount" value="1"/>
							<button class="increase">+</button>
						</dd>
						<dt>库存</dt>
						<dd class="inventory"><?php echo ($goods["stock"]); ?>件</dd>
						<input type="hidden" name="goods_id" value="<?php echo ($goods["id"]); ?>" />
						<dd class="options">
							<button onclick="javascript:window.location.href='settlement.html'">
								<img src="/Public/img/ljgm.png"> 立即购买
							</button>
							<button type="submit">
								<img src="/Public/img/sygw.png"> 加入购物车
							</button>
						</dd>
					</dl>
				</form>
			</div>
			<div class="sample">
				<div class='lightSlider-content'>
					<ul>
						<?php if(is_array($galleries)): $i = 0; $__LIST__ = $galleries;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gallery): $mod = ($i % 2 );++$i;?><li data-thumb="<?php echo ($gallery["path"]); ?>">
								<img src="<?php echo ($gallery["path"]); ?>">
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div class="details">
				<p class="title"><span class="tab actived">商品详情</span><a href="#comment"><span class="tab">累计评价<span class="amount">2453</span></span></a></p>
				<dl>
					<dt>商品参数</dt>
					<dd class="data">
						<ul>
							<li>生产许可证编号：QS3502 1401 1887</li>
							<li>保质期：720 天</li>
							<li>省份: 福建省</li>
							<li>茶种类: <?php echo ($goodsCategory["name"]); ?></li>
						</ul>
						<ul>
							<li>产品标准号：<?php echo ($goods["sn"]); ?></li>
							<li>产品名称：森舟 大红袍一斤装</li>
							<li>系列: 大红袍一斤装</li>
							<li>净含量: 500g</li>
						</ul>
						<ul>
							<li>储藏方法：避光、防潮、防异味</li>
							<li>生长季节: 春季</li>
							<li>城市: 武夷山市</li>
						</ul>
					</dd>
					<dt>商品详情</dt>
					<dd class="picture">
						<?php echo ($detail["content"]); ?>
					</dd>
					<dt id="comment">商品评论</dt>
					<dd class="present">
						<blockquote>
							<span></span><br />
							好评度
						</blockquote>
						<ul>
							<li>好评：
								<div class="progress_bar">
									<div class="progress good"></div>
								</div>
							</li>
							<li>中评：
								<div class="progress_bar">
									<div class="progress normal"></div>
								</div>
							</li>
							<li>差评：
								<div class="progress_bar">
									<div class="progress bad"></div>
								</div>
							</li>
						</ul>
						<p><input type="radio" name="filter" checked="checked" >全部<input type="radio" name="filter">追评（621）<input type="radio" name="filter">图片（121）</p>
					</dd>
					<dd class="comment">
						<div class="uname"><img class="placeholder" src="/Public/img/placeholder_1x1.png" />125*****46(匿名)</div>
						<p class="text">价格实惠 老顾客了。茶叶不错，香气扑鼻，汤色诱人，这款已经买过几次，性价比不错。送礼没有问题的 包装的也好。 服务态度太好了，好的事无巨细</p>
						<p class="time">2016/10/06  09:42</p>
					</dd>
					<dd class="comment">
						<div class="uname"><img class="placeholder" src="/Public/img/placeholder_1x1.png" />尔*****因(匿名)</div>
						<p class="text">这是我第三次购买大红袍了，看看吧，质量优，价格更优惠，非常完美，性价比高，值得拥有，好评加五星，祝商家财源滚滚，生意兴隆！</p>
						<img src="/Public/img/product/spxq-plt1.jpg" />
						<img src="/Public/img/product/spxq-plt2.jpg" />
						<img src="/Public/img/product/spxq-plt3.jpg" />
						<p class="time">2016/10/01  15:08</p>
					</dd>
					<dd class="comment">
						<div class="uname"><img class="placeholder" src="/Public/img/placeholder_1x1.png" />西*****梦(匿名)</div>
						<p class="text">又是回购了，茶叶味好，价格公道，！喝完再来！</p>
						<img src="/Public/img/product/spxq-plt1.jpg" />
						<img src="/Public/img/product/spxq-plt2.jpg" />
						<p class="time">2016/09/24  11:26</p>
					</dd>
					<dd class="comment">
						<div class="uname"><img class="placeholder" src="/Public/img/placeholder_1x1.png" />128*****78(匿名)</div>
						<p class="text">之前都是喝这款大红袍的，味道挺好的，价格也比较实惠。味道浓郁，茶汤清亮，是上等的好茶。</p>
						<p class="time">2016/10/06  09:42</p>
					</dd>
					<dt>发表评论</dt>
					<dd class="my-comment">
						<p class="radioGroup">评级：<input type="radio" name="rate" >好评<input type="radio" name="rate" >中评<input type="radio" name="rate" >差评</p>
						<textarea class="inputComment" maxlength="256"></textarea>
						<button class="submit button_color_scheme_dark">提交</button>
					</dd>
				</dl>
			</div>
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
	
	<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/Public/js/jquery.auto-complete.min.js"></script>
	<script type="text/javascript" src="/Public/js/lightslider.js"></script>
	<script type="text/javascript" src="/Public/js/basic.js"></script>
	<script type="text/javascript">
		$(".center .description .amount button").addClass("button_color_scheme_dark");
		$(".center .description .options button").addClass("button_color_scheme_dark borderRadius_scheme_small");

		$(function(){
			$(".center .sample .lightSlider-content >ul").lightSlider({
				item: 1,
				loop: true,
				gallery:true,
				thumbItem: 4,
				galleryMargin: 15,
				thumbMargin: 15
			});
		});
	</script>

</html>