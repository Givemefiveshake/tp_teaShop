<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
欢迎支付抖抖抖旗下商品,扫描下方二维码支付
<br>
<img src="<?php echo U('Qrcode/index',['text' => $text]);?>">
</body>
</html>