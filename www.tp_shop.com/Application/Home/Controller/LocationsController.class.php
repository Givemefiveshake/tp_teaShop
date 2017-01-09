<?php


namespace Home\Controller;


use Think\Controller;

class LocationsController extends Controller
{
    public function getListByPid($pid){
        $data = D('Locations')->getListByPid($pid);
        $this->ajaxReturn($data);
    }
}