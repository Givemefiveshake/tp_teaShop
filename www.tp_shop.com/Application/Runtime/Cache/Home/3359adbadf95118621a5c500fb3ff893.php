<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="http://www.itsource.cn/upload/operationableFile/logo_small.jpg " />
		<title>注册</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="/Public/css/basic.css" rel="stylesheet" type="text/css">
		<link href="/Public/css/register.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/Public/js/jquery.auto-complete.min.js"></script>
	</head>

	<body>
		<!-- header -->
		<div class="panel header">
			<a href="index.html"><img class="logo" src="/Public/img/logo_2.png"></a>
			<div class="top_menu">
				<p class="at_login">
					<a href="index.html">首页</a><span class="spliter">|</span>
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
					<button class="cart" type="button" onclick="javascript:window.location.href='ucart.html'"><img src="/Public/img/sygw.png">　购物车</button>
				</div>
				<p class="not_login">
					<a href="login.html">登录</a><span class="spliter">|</span>
					<a href="register.html">注册</a><span class="spliter">|</span>
					<a href="ucenter.html">用户中心</a>
				</p>
				<p class="is_login"><span class="uname" name="uname">源码时代</span><span class="greetings">下午好~</span>
					<a href="">退出</a>
				</p>
			</div>
			<p class="menu">
				<a href="index.html">首页</a><span class="spliter">|</span>
				<a href="product_list.html">朴茶区</a><span class="spliter">|</span>
				<a href="product_list.html">有机区</a><span class="spliter">|</span>
				<a href="product_list.html">老茶区</a><span class="spliter">|</span>
				<a href="product_list.html">自饮区</a><span class="spliter">|</span>
				<a href="product_list.html">老牌区</a><span class="spliter">|</span>
			</p>
		</div>

		<!-- center -->
		<div class="panel center">
			<p class="title">用户注册</p>
			<form action="<?php echo U('User/register');?>" method="post">
				<ul>
					<li>用　户　名　
						<input class="uname" name="username" type="text" placeholder="请输入你喜欢的昵称" />
					</li>
					<li>姓　　　名　
						<input class="rname" name="real_name" type="text" placeholder="请输入正确的姓名" />
					</li>
					<li>出生年月日　
						<input class="uage" name="birth" type="date" placeholder="请输入正确的出生年月日" />
					</li>
					<li>邮　　　箱　
						<input class="uemail" name="email" type="text" placeholder="请输入正确的格式" />
					</li>
					<li>
						<span style="letter-spacing: 0.33em; margin-right: -0.33em;">手机号码</span>　
						<input class="uphone" name="tel" type="text" placeholder="请输入正确的手机号" />
						<button class="verification_code" type="button">获取验证码</button>
					</li>
					<li>手机验证码　
						<input class="pwd" name="telcode" type="text" placeholder="请输入手机验证码" />
					</li>
					<li>密　　　码　
						<input class="pwd" name="password" type="password" placeholder="请输入密码" />
					</li>
					<li><span style="letter-spacing: 0.33em; margin-right: -0.33em;">确认密码</span>　
						<input class="pwd_confirm" name="repassword" type="password" placeholder="请确认密码" />
					</li>
					<li>　　　　　　
						<button class="submit" value="submit">注　册</button>
					</li>
				</ul>
			</form>
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
			<!--描述：百度分享  -->
			<script>
				window._bd_share_config = {
					"common": {
						"bdSnsKey": {},
						"bdText": "源码时代，专业的Java、PHP、UI、Web前端培训！",
						"bdMini": "1",
						"bdMiniList": false,
						"bdPic": "http://www.itsource.cn/images/new/wx.png",
						"bdStyle": "0",
						"bdSize": "24"
					},
					"slide": {
						"type": "slide",
						"bdImg": "0",
						"bdPos": "left",
						"bdTop": "100"
					}
				};
				with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api//Public/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
			</script>
		</div>
	</body>

	<script type="text/javascript" src="/Public/js/basic.js"></script>
	<script type="text/javascript" src="/Public/ext/layer/layer.js"></script>
	<script type="text/javascript">
		$(".center input").addClass("borderRadius_scheme_large");
		$(".center button").addClass("button_color_scheme_dark borderRadius_scheme_large");
		$(".center .verification_wrapper input, .center .verification_wrapper button").removeClass("borderRadius_scheme_large").addClass("borderRadius_scheme_small");

		//点击弹出验证码框
		$('.verification_code').click(tmp);

		//layer插件做的验证码框
		function tmp(){
			//页面层
			layer.open({
				title: '验证码',
				type: 1,
				skin: 'layui-layer-rim', //加上边框
				area: ['220px', '170px'], //宽高
				content: '<div style="text-align: center;padding: 5px">\
			<input type="text" class="verification" /><hr>\
					<img src=\'<?php echo U("Captcha/verify");?>\' width="200px"/><br>\
					<input type="button" onclick="sendSms()" value="发送" />\
					</div>'
			});
		}

		//拿到手机号和验证码数据
		function sendSms(){
			//关闭所有的弹出窗口
			layer.closeAll();
			//获取验证码
			var phoneNum = $('.uphone').val();
			var code = $('.verification').val();
			var url = '<?php echo U("User/sms");?>';
			//将获取的验证码和手机号存到一个数组中
			var data = {
				tel:phoneNum,
				verify:code
			};
//			console.debug(data);
//			return;
			//回调函数
			$.getJSON(url,data,function(res){
//				console.debug(res);
				if(res.status == 1){
					layer.alert(res.msg,{icon:6});
				}else{
					layer.alert(res.msg,{icon:5});
				}
			});
		}
	</script>
</html>