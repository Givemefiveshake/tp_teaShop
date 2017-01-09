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