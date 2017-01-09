<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>收货地址管理</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='/Public/css/bootstrap.css'/>
        <style type="text/css">
            .error{
                color:red;
            }
        </style>
    </head>
    <body>
        <div class="container">
            收货地址管理
        </div>
        <div class="container">
            <table class="table table-advance table-bordered table-hover table-striped">
                <tr>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>地址</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($addresses)): foreach($addresses as $key=>$address): ?><tr>
                        <td><?php echo ($address["name"]); ?></td>
                        <td><?php echo ($address["tel"]); ?></td>
                        <td><?php echo ($address["province_name"]); ?> <?php echo ($address["city_name"]); ?> <?php echo ($address["area_name"]); ?> <?php echo ($address["detail_address"]); ?></td>
                        <td>

                 <a href=""  >删除</a>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
        <div class='container'>
            <form class='form-inline' method="post" action="<?php echo U();?>" id="address-form">
                <div class='form-group'>
                    <select class="form-control province" name="province_id">
                        <option>请选择省份</option>
                        <?php if(is_array($provinces)): foreach($provinces as $key=>$province): ?><option value="<?php echo ($province["id"]); ?>"><?php echo ($province["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <input type="hidden" name="province_name" class="province_name"/>
                    <select class="form-control city" name="city_id">
                        <option>请选择城市</option>
                    </select>
                    <input type="hidden" name="city_name" class="city_name"/>
                    <select class="form-control area" name="area_id">
                        <option>请选择地区</option>
                    </select>
                    <input type="hidden" name="area_name" class="area_name"/>
                </div>
                <div style="margin-top:10px;"></div>
                <div class='form-group'>
                    <input type="text" style="width:400px" name="detail_address" class="form-control" placeholder="请输入详细地址"/>
                </div>
                <div style="margin-top:10px;"></div>
                <div class='form-group'>
                    <input type="text" class="form-control" name="name" placeholder="请输入收货姓名"/>
                </div>
                <div style="margin-top:10px;"></div>
                <div class='form-group'>
                    <input type="text" class="form-control" name="tel" placeholder="请输入手机号码"/>
                </div>
                <div style="margin-top:10px;"></div>
                <div class='form-group'>
                    <input type="submit" class="form-control btn btn-primary" value=" 添加 "/>
                </div>
            </form>
        </div>

        <script type="text/javascript" src='/Public/js/jquery-1.10.2.min.js'></script>
        <script type="text/javascript" src='/Public/js/jquery.validate.min.js'></script>
        <script type="text/javascript">
            $(function () {
                var url = '<?php echo U("Locations/getListByPid");?>';
                $('.province').change(function () {
                    //        获取选择的省份
                    var province_id = $(this).val();
                    var data = {pid: province_id};
                    $.getJSON(url, data, function (res) {
                        //          删除城市中除了第一个option外的option
                        $('.city').get(0).length = 1;
                        $('.area').get(0).length = 1;
                        $('.city_name').val('');
                        $('.area_name').val('');
                        $(res).each(function (i, v) {
                            var html = '<option value="' + v.id + '">' + v.name + '</option>';
                            $(html).appendTo($('.city'));
                        });
                    });
                });
                $('.city').change(function () {
                    //获取选择的城市
                    var city_id = $(this).val();
                    var data = {pid: city_id};
                    $.getJSON(url, data, function (res) {
                        //删除城市中除了第一个option外的option
                        $('.area').get(0).length = 1;
                        $('.area_name').val('');
                        $(res).each(function (i, v) {
                            var html = '<option value="' + v.id + '">' + v.name + '</option>';
                            $(html).appendTo($('.area'));
                        });
                    });
                });

                //当点击对应的省市区的时候,将名字放在隐藏域中
                $('.province').click(function () {
                    var pname = $(this).find(':checked').text();
                    $('.province_name').val(pname);
                });
                $('.city').click(function () {
                    var pname = $(this).find(':checked').text();
                    $('.city_name').val(pname);
                });
                $('.area').click(function () {
                    var pname = $(this).find(':checked').text();
                    $('.area_name').val(pname);
                });

                //-----------------jquery-validation分割线-------------
                $("#address-form").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 2
                        },
                        tel: {
                            required: true,
                            chinaTel:true,
                        },
                        province_id: {
                            required: true,
                        },
                        detail_address: {
                            required: true,
                        },
                        city_id: {
                            required: true,
                        },
                        area_id: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: "收货人不能为空",
                            minlength: "姓名长度不合法"
                        },
                        tel: {
                            required: "手机号码不能为空",
                            chinaTel: "手机号码不合法"
                        },
                        detail_address: {
                            required: "详细地址不能为空",
                        },
                        province_id: {
                            required: "省份不能为空",
                        },
                        city_id: {
                            required: "城市不能为空",
                        },
                        area_id: {
                            required: "地区不能为空",
                        },
                    }
                });

                $.validator.addMethod('chinaTel', validateChinaPhone, "手机号码不合法");
                function validateChinaPhone(value) {
                    if (/^1[34578]\d{9}$/m.test(value)) {
                        // Successful match
                        return true;
                    } else {
                        // Match attempt failed
                        return false;
                    }
                }

            });
        </script>
    </body>
</html>