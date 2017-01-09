<?php


namespace Home\Controller;


use Think\Controller;

class AddressController extends Controller
{

    public function add(){
        if(IS_POST){
            $address_model = D('Address');
            if($address_model->create()===false){
                $this->error(get_errors($address_model));
            }
            if($address_model->add()===false){
                $this->error(get_errors($address_model));
            }
            $this->success('添加地址成功',U('add'));
        }else
            $province = D('Locations')->getListByPid(0);
            $this->assign('provinces',$province);

            $data = D('Address')->select();
            $this->assign('addresses',$data);
            $this->display('address');
    }
}