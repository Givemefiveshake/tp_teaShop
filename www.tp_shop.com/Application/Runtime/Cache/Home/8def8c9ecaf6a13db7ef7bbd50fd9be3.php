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
		
	<link href="/Public/css/ucenter.css" rel="stylesheet" type="text/css">

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

			<!-- banner START -->
			<div class="banner">
				<img class="logo" src="/Public/img/ucenter/ulogo.png" />
				<p><span class="uname">源码时代</span><span class="greetings">下午好~~</span><br />
					上次于2016年10月07日 10:22 在成都登录成功</p>
			</div>
			<!-- banner END -->
			<!-- "新品上市" START -->
			<div class="tabs_nav">
				<ul>
					<li class="order_list">订单列表</li>
				</ul>
			</div>
			<div class="tabs">
				<ul>
					<li class="order_list">
						<p class="title2">订单列表</p>
						<table class="all">
							<tr>
								<th>商品信息</th>
								<th>实付款</th>
								<th>订单状态</th>
							</tr>
							<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td>
										<p>
											<span class="date"><?php echo date('Y-m-d',$order['create_time']);?></span>
											<span class="sequence">订单号：<?php echo ($order["id"]); ?></span>
										</p>
										<?php if(is_array($orderDetails)): $i = 0; $__LIST__ = $orderDetails;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orderDetail): $mod = ($i % 2 );++$i; if($order['id'] == $orderDetail['order_id']): ?><img src="<?php echo ($orderDetail["logo"]); ?>" style="width: 100px;height: 100px">
												<ul>
													<li>商品ID:<?php echo ($orderDetail["goods_id"]); ?></li>
													<li>商品名称:<?php echo ($orderDetail["goods_name"]); ?></li>
													<li>购买数量:<?php echo ($orderDetail["amount"]); ?></li>
												</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								<td><?php echo ($order["price"]); ?></td>
								<td>
									<?php switch($order['status']): case "1": ?><a href="<?php echo U('Order/pay',['id' => $order['id']]);?>" style='background: #5FB878;padding: 7px 12px;'>去支付</a><?php break;?>
										<?php case "2": ?>待发货<?php break;?>
										<?php case "3": ?><a href="" style='background: #5FB878;padding: 7px 12px;'>确认收货</a><?php break;?>
										<?php case "4": ?>交易完成<?php break; endswitch;?>
								</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
					</li>
				</ul>
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
	
	<script type="text/javascript" src="/Public/js/jquery.cxselect.min.js"></script>
	<script type="text/javascript" src="/Public/js/jquery.editable.min.js"></script>
	<script type="text/javascript">

		$(".center .tabs li [type='text'], .center .tabs .user_info select").addClass("borderRadius_scheme_small");
		$(".center .tabs li button").addClass("button_color_scheme_dark borderRadius_scheme_middle");

		$(function(){

			/* Tabs navigator module START */

			// First level tabs

			var $tabs_nav = $(".center .tabs_nav >ul");
			var $tabs_nav_trigger = $tabs_nav.children("li");
			var $tabs = $(".center .tabs >ul");
			var $tabs_item = $tabs.children("li");

			var current_tab_class;
			$tabs_nav_trigger.on("click", function(){
				current_tab_class = $(this).attr('class');

				$tabs_nav_trigger.css({'color': '#000000'});
				$tabs_nav.children("." + current_tab_class).css({'color': '#a0603d'});

				$tabs_item.css({'display':'none'});
				$tabs.children("." + current_tab_class).css({'display':'initial'});
				$tabs.height($tabs.children("." + current_tab_class).height());
			}).hover(function(){
				$(this).css({"cursor":"pointer"});
			}).eq(0).trigger("click");

			// Order list tabs

			var $order_list = $(".center .tabs .order_list");
			var $order_list_nav = $order_list.children(".caption_nav");
			var $order_list_nav_trigger = $order_list_nav.children("li");
			var $order_list_item = $order_list.children("table");

			$order_list_nav_trigger.on("click", function(){

				$order_list_nav_trigger.css({'color': '#000000'});
				$order_list_nav.children("." + $(this).attr('class')).css({'color': '#a0603d'});

				$order_list_item.css({'display':'none'});
				$order_list.children("." + $(this).attr('class')).css({'display':'inline-table'});
				$tabs_nav.children("." + current_tab_class).trigger("click");
			}).hover(function(){
				$(this).css({"cursor":"pointer"});
			}).eq(0).trigger("click");

			/* Tabs navigator module END */

			/* Wait4pay module START */
			$order_list.children(".wait4pay").find(".delete").click(function(){
				$(this).parent().parent().remove();
				// Update UI.
				$order_list_nav.children(".wait4pay").trigger("click");
			}).hover(function(){
				$(this).css({"cursor":"pointer"});
			});
			/* Wait4pay module END */

			/* Address module START */

			var editable_params = {
				lineBreaks : true,
				toggleFontSize : false,
				closeOnEnter : true
			}

			var $address_list = $(".center .addresses");

			// Click to set as default.
			$address_list.find(".default").live({
				click: function(){
					$(this).find("[name='is_default']").attr({"checked":"checked"});
				},
				hover: function(){
					$(this).css({"cursor":"pointer"});
				}
			});

			var $add_address = $address_list.find(".add_address");

			// Add blank address and hide add trigger.
			$add_address.click(function(){
				// Create object.
				$newAddress = $('<li>'+
						'<p class="uname">源码时代</p>'+
						'<p class="pre_address"><select class="province" data-value="四川省"></select><select class="city" data-value="成都市"></select><select class="area" data-value="高新区"></select></p>'+
						'<p class="address" title="双击编辑" old="">地址</p>'+
						'<p class="uphone" title="双击编辑">电话</p>'+
						'<p><button class="save  button_color_scheme_dark">保存该地址</button> <button class="cancel  button_color_scheme_dark">取消</button></p>'+
						'</li>');

				// Select pre-address.
				$newAddress.find('.pre_address').cxSelect({
					url: 'json/cityData.min.json',
					selects: ['province', 'city', 'area'],
					emptyStyle: 'none'
				});

				// Enable directly editing.
				$newAddress.find('.address').editable(editable_params);
				$newAddress.find('.uphone').editable(editable_params);

				// Add to list.
				$newAddress.insertBefore($(this));

				// Hide trigger.
				$(this).css({"display":"none"});
			}).hover(function(){
				$(this).css({"cursor":"pointer"});
			});


			// Save new address.
			$address_list.find(".save").live("click", function(){
				$(this).parent().parent().append(
						'<button class="delete button_color_scheme_dark borderRadius_scheme_middle">删除</button><p class="default"><input type="radio" name="is_default" >作为默认地址</p>'
				);
				// Show add trigger.
				$add_address.css({"display":"initial"});
				// Update UI.
				$tabs_nav.children(".delivery_addresses").trigger("click");
				// Clear.
				$(this).parent().remove();
			});

			// Cancel using new address.
			$address_list.find(".cancel").live("click", function(){
				$(this).parent().parent().remove();
				$add_address.css({"display":"initial"});
			});

			// Delete address.
			$address_list.find(".delete").live("click", function(){
				$(this).parent().remove();
			});

			// Select pre-address.
			$pre_address = $address_list.find(".pre_address");
			$pre_address.cxSelect({
				url: 'json/cityData.min.json',
				selects: ['province', 'city', 'area'],
				emptyStyle: 'none'
			});

			// Directly edit address.
			var $address = $address_list.find(".address");
			var $uphone = $address_list.find(".uphone");
			var currentEditingAddress;
			$address.editable(editable_params);
			$uphone.editable(editable_params);

			// Listen on when elements getting edited

			var editing_func = function() {
				currentEditingAddress = $(this);
				currentEditingAddress.attr({"old":$(this).find("textarea").val()});
				currentEditingAddress.find('textarea').css({"background-color":"white"});
			}

			$address.live('edit', editing_func);
			$uphone.live('edit', editing_func);

			$address.live('edit', function() {
				currentEditingAddress.find('textarea').attr({"maxlength":"44"});
			});
			$uphone.live('edit', function() {
				currentEditingAddress.find('textarea').attr({"maxlength":"11"});
			});

			// Listen on when elements cancel edited
			$(document).keydown(function(event){
				if(event.keyCode == 27){
					currentEditingAddress.editable('close');
					currentEditingAddress.text(currentEditingAddress.attr("old"));
				}
			});

			/* Adress module END */

		});
	</script>

</html>