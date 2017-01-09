<?php


namespace Admin\Model;

use Admin\Logic\DbMysqlLogic;
use Admin\Logic\NestedSets;
use Think\Model;

class GoodsCategoryModel extends Model
{
    /**
     * 读取所有数据做展示
     */
    public function getAllData(){
        return $this->order('lft')->select();
    }

    /**
     * 添加数据分类
     */
    public function addData(){
        $mysql_db = new DbMysqlLogic();
        $nestedSets = new NestedSets($mysql_db, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
        $result = $nestedSets->insert($this->data['parent_id'],$this->data,'bottom');
        return $result;
    }

    /**
     * @param $id
     * @return bool
     * 删除分类,如果分类下有数据则不能删除
     */
    public function deleteData($id){
        //查找所有后代分类
        $mysql_db = new DbMysqlLogic();
        $nestedSets = new NestedSets($mysql_db, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
        $descendants = $nestedSets->getDescendants($id);
        //获取所有后代分类id
        $ids = [];
        foreach($descendants as $descendant){
            $ids[] = $descendant['id'];
        }
        if(empty($ids)){
            return true;
        }
        //查询商品表中在这些分类下是否有商品
        $goodsModel = M('goods');
        $count = $goodsModel->where(['category_id' => ['in',$ids]])->count();
        if($count){
            $this->error = '该分类下有商品,不能删除';
            return false;
        }
        if($nestedSets->delete($id) === false){
            $this->error = '删除失败';
            return false;
        }
        return true;
    }

    public function saveCategory(){
        //判断是否修改了父级分类
        $currentPid = $this->data['parent_id'];
        //获取数据库中原来的父级id,使用getField不会调用find()方法,不会覆盖当前对象的data属性
        $oldPid = $this->where(['id'=>$this->data['id']])->getField('parent_id');

        //如果修改了
        if($currentPid != $oldPid){
            $mysql_db = new DbMysqlLogic();
            $nestedSets = new NestedSets($mysql_db, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'level');
            if(!$nestedSets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom')){
                $this->error = '父级分类不合法';
                return false;
            }
        }
        //保存基本信息
        return $this->save();
    }
}