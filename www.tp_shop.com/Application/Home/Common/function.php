<?php
/**
 * 将模型中的错误信息转成一个有序列表返回
 */
function get_errors(\Think\Model $model){
    $errors = $model->getError();
    if(!is_array($errors)){
        //如果得到的不是个数组,就转换成数组
        $errors = array($errors);
    }
    $html = '<ol>';
    foreach($errors as $error){
        $html .= '<li>'.$error.'</li>';
    }
    $html .= '</ol>';
    return $html;
}

/**
 * 发送邮件
 * @param $address
 * @param $subject
 * @param $content
 * @return array
 * @throws Exception
 * @throws phpmailerException
 */
function sendEmail($address,$subject,$content){
    vendor('PHPMailer.PHPMailerAutoload');

    $mail = new \PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = C('MAILER.Host');  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = C('MAILER.Username');                 // SMTP username
    $mail->Password = C('MAILER.Password');                           // SMTP password
    $mail->SMTPSecure = C('MAILER.SMTPSecure');                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = C('MAILER.Port');                                    // TCP port to connect to
    $mail->CharSet = 'UTF-8';                        //设置字符集
    $mail->setFrom(C('MAILER.Username'));
    $mail->addAddress($address);     // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $content;

    if(!$mail->send()) {
        $data = [
            'status' => 0,
            'msg' => $mail->ErrorInfo
        ];
    } else {
        $data = [
            'status' => 0,
            'msg' => '邮件发送成功'
        ];
    }
    return $data;
}

/**
 * 短信验证
 * @param $tel
 * @param $dataSms
 * @return array
 */
function sendSms($tel,$dataSms){
    //要使用阿里大鱼的短信验证,需要将类文件引入,没有.class.php结尾的文件放在vendor中,直接使用vendor方法引入文件
    vendor('alidayu.TopSdk');
    //因为没有命名空间,所以前面要加\表示不是上面的命名空间中的类
    $c = new \TopClient;
    $c ->appkey = C('SMS_SENDER.AK') ;
    $c ->secretKey = C('SMS_SENDER.SK') ;
    $req = new \AlibabaAliqinFcSmsNumSendRequest;
    $req ->setExtend( "" );
    $req ->setSmsType( "normal" );
    $req ->setSmsFreeSignName( C('SMS_SENDER.SIGN') );
    //将传入的模版内容(来源和短信验证码)转成json字符串传给setSmsParam
    $json = json_encode($dataSms);
    $req ->setSmsParam( $json );
    $req ->setRecNum( $tel );
    $req ->setSmsTemplateCode( C('SMS_SENDER.TEMPLATE') );
    $resp = $c ->execute( $req );
//        dump($resp);die;
    if(isset($resp->result) && isset($resp->result->success)){
        $data = [
            'status' => 1,
            'msg' => '消息发送成功'
        ];
    }else{
        $data = [
            'status' => 0,
            'msg' => $resp->error_response->sub_msg,
        ];
    }
    return $data;
}

/**
 * 获取登录用户的id
 * @return mixed
 */
function getUserId(){
    return session('userInfo.id');
}