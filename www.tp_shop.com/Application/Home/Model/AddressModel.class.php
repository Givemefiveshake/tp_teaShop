<?php


namespace Home\Model;


use Think\Model;

class AddressModel extends Model
{
    protected $_auto = [
        ['user_id','getUserId',1,'function'],
    ];

    public function getAddress(){
        return $this->where(['user_id' => getUserId()])->select();
    }
}