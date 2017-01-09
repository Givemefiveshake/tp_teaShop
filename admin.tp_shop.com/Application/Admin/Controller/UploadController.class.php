<?php


namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    public function Upload(){
        //文件上传
        $options = C('UPLOAD_SETTING.SETTING');
        $upload = new Upload($options);
        $fileInfo = array_pop($upload->upload());
        if($fileInfo){
            //上传成功,返回文件路径
            //比较字符串,不区分大小写,看是否是使用了七牛云
            if(strnatcasecmp($upload->driver,'qiniu' == 0)){
                $url = $fileInfo['url'];
            }else{
                $url = C('UPLOAD_SETTING.URL_PREFIX').$fileInfo['savepath'].$fileInfo['savename'];
            }
            //拼接数据
            $data = [
                'status' => 1,
                'msg' => '上传成功',
                'url' => $url,
            ];
        }else{
            //上传失败,返回错误原因
            $data = [
                'status' => 0,
                'msg' => '上传失败',
                'url' => '',
            ];
        }
        $this->ajaxReturn($data);
    }
}