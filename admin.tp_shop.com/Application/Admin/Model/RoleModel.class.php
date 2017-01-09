<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class RoleModel extends Model
{
    public function DataPage($size){
        $count = $this->count();
        $pages = new Page($count,$size);

        $data = $this->order('sort')->limit($pages->firstRow,$pages->listRows)->select();
        $page = $pages->show();

        return [$data,$page];
    }

    public function addRole(){
        $role_id = $this->add();
        $permission_ids = I('post.permission_id');
        if(empty($permission_ids)){
            return true;
        }
        $data = [];
        foreach($permission_ids as $permission_id){
            $data[] = [
                'role_id' => $role_id,
                'permission_id' => $permission_id
            ];
        }
        return M('RolePermission')->addAll($data);
    }

    public function getRoleInfo($id){
        $row = $this->find($id);
        $permission_ids = M('RolePermission')->where(['role_id' => $id])->getField('permission_id',true);
        $row['permission_ids'] = json_encode($permission_ids);
        return $row;
    }

    public function editRole($id){
        $this->save();
        //删除关联表中之前的数据
        M('RolePermission')->where(['role_id' => $id])->delete();
        //拼接现在的数据
        $permission_ids = I('post.permission_id');
        if(empty($permission_ids)){
            return true;
        }
        $data = [];
        foreach($permission_ids as $permission_id){
            $data[] = [
                'role_id' => $id,
                'permission_id' => $permission_id
            ];
        }
        return M('RolePermission')->addAll($data);
    }

    public function deleteRole($id){
        //删除关联关系
        M('RolePermission')->where(['role_id' => $id])->delete();
        //删除当前表数据
        return $this->delete($id);
    }
}