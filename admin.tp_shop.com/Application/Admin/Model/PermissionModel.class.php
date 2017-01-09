<?php


namespace Admin\Model;

use Admin\Logic\DbMysqlLogic;
use Admin\Logic\NestedSets;
use Think\Model;

class PermissionModel extends Model
{
    public function addPermission(){
        $dbMysqlLogic = new DbMysqlLogic();
        $nestedSets = new NestedSets($dbMysqlLogic,'Permission','lft','rght','parent_id','id','level');
        $re = $nestedSets->insert($this->data['parent_id'],$this->data,'bottom');
        if($re === false){
            $this->error = '新增失败';
            return false;
        }
        return $re;
    }

    public function editPermission(){
        //判断是否修改了父级分类
        $currentPid = $this->data['parent_id'];
        //获取数据库中原来的父级id,使用getField不会调用find()方法,不会覆盖当前对象的data属性
        $oldPid = $this->where(['id' => $this->data['id']])->getField('parent_id');

        if ($currentPid != $oldPid) {
            $dbMysqlLogic = new DbMysqlLogic();
            $nestedSets = new NestedSets($dbMysqlLogic, 'Permission', 'lft', 'rght', 'parent_id', 'id', 'level');
            if(!$nestedSets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom')){
                $this->error = '父级分类不合法';
                return false;
            }
        }
        //保存基本信息
        return $this->save();
    }

    /**
     * 删除权限
     * @param $id
     * @return bool
     */
    public function removePermission($id){
        //查询该分类下的后代
        $dbMysqlLogic = new DbMysqlLogic();
        $nestedSets = new NestedSets($dbMysqlLogic, 'Permission', 'lft', 'rght', 'parent_id', 'id', 'level');
        $descendants = $nestedSets->getDescendants($id);
        $ids = [];
        foreach($descendants as $descendant){
            $ids[] = $descendant['id'];
        }
        if(empty($ids)){
            //如果没有后代则可以删除
            return true;
        }
        //删除权限时,同时删除关联表的关联权限
        if(M('role_permission')->where(['permission_id' => ['in',$ids]])->delete() === false){
            $this->error = '删除关联权限失败';
            return false;
        }
        //没有后代则执行删除操作
        if($nestedSets->delete($id) === false){
            $this->error = '删除失败';
            return false;
        }
        return true;
    }

    /**
     * 获所有取权限数据
     * @return array
     */
    public function getList(){
        $list = $this->order('lft')->select();
        if(is_null($list)){
            $list = [];
        }
        return $list;
    }
}