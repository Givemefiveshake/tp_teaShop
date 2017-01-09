<?php


namespace Admin\Model;

use Admin\Logic\DbMysqlLogic;
use Admin\Logic\NestedSets;
use Think\Model;

class MenuModel extends Model
{
    /**
     * 新增菜单
     * @return bool|false|int
     */
    public function addMenu(){
        $dbMysqlLogic = new DbMysqlLogic();
        $nestedSets = new NestedSets($dbMysqlLogic,'Menu','lft','rght','parent_id','id','level');
        $re = $nestedSets->insert($this->data['parent_id'],$this->data,'bottom');
        if($re === false){
            $this->error = '新增失败';
            return false;
        }
        //保存关联关系
        $permission_ids = I('post.permission_id');
        if(empty($permission_ids)){
            return true;
        }
        $data = [];
        foreach($permission_ids as $permission_id){
            $data[] = [
                'menu_id'=>$re,
                'permission_id'=>$permission_id,
            ];
        }
        if(M('MenuPermission')->addAll($data)===false){
            $this->error = '保存关联失败';
            return false;
        }else{
            return true;
        }
    }

    public function editMenu($id){
        //判断是否修改了父级分类
        $currentPid = $this->data['parent_id'];
        //获取数据库中原来的父级id,使用getField不会调用find()方法,不会覆盖当前对象的data属性
        $oldPid = $this->where(['id' => $id])->getField('parent_id');

        if ($currentPid != $oldPid) {
            $dbMysqlLogic = new DbMysqlLogic();
            $nestedSets = new NestedSets($dbMysqlLogic, 'Menu', 'lft', 'rght', 'parent_id', 'id', 'level');
            if(!$nestedSets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom')){
                $this->error = '父级分类不合法';
                return false;
            }
        }
        //保存基本信息
        if($this->save() === false){
            return false;
        }

        //保存关联关系
        M('MenuPermission')->where(['menu_id'=>$id])->delete();
        $permission_ids = I('post.permission_id');
        if(empty($permission_ids)){
            return true;
        }
        $data = [];
        foreach($permission_ids as $permission_id){
            $data[] = [
                'menu_id'=>$id,
                'permission_id'=>$permission_id,
            ];
        }
        if(M('MenuPermission')->addAll($data)===false){
            $this->error = '保存关联失败';
            return false;
        }else{
            return true;
        }
    }

    //删除列表
    public function removeMenu($id){
        //查询该分类下的后代
        $dbMysqlLogic = new DbMysqlLogic();
        $nestedSets = new NestedSets($dbMysqlLogic, 'Menu', 'lft', 'rght', 'parent_id', 'id', 'level');
        if($nestedSets->delete($id) === false){
            $this->error = '删除失败';
            return false;
        }
        //删除和权限的关联关系
        if((M('MenuPermission')->where(['menu_id' => $id])->delete()) === false){
            return false;
        }
        return true;
    }

    /**
     * 得到列表一般数据和权限数据
     * @param $id
     * @return mixed
     */
    public function getMenuInfo($id){
        $row = $this->find($id);
        $permission_ids = M('MenuPermission')->where(['menu_id'=>$id])->getField('permission_id',true);
        $row['permission_ids'] = json_encode($permission_ids);
        return $row;
    }

    /**
     * 根据权限展示菜单数据
     * @return array
     */
    public function getMenuList() {
        $username = session('admin.username');
        //超级管理员可以看到所有的菜单.
        if($username == 'admin'){
            $menus = $this->field('id,parent_id,name,path,level')->order('lft')->select();
        }else{
            //普通管理员,需要根据权限展示菜单.
            $permission_ids = array_keys(session('permission'));
            if(empty($permission_ids)){
                return [];
            }
            $menus = $this->distinct(true)->field('id,parent_id,name,path,level')->alias('m')->join('menu_permission mp on mp.menu_id=m.id')->where(['permission_id'=>['in',$permission_ids]])->order('lft')->select();
        }
        return $menus;
    }

}