<?php


namespace Home\Model;


use Think\Model;

class LocationsModel extends Model
{
    public function getListByPid($pid){
        return $this->where(['parent_id' => $pid])->select();
    }
}