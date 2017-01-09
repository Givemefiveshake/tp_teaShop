<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class AdminModel extends Model
{
    //自动验证
    protected $_validate = [
        ['email', 'email', '邮箱格式错误', 0, 'regex', 3],
        ['repassword', 'password', '两次密码不一致', 0, 'confirm', 3],
    ];

    //自动完成
    protected $_auto = [
        ['add_time', 'time', 1, 'function'],
        ['salt', 'generateSalt', 1, 'callback']
    ];

    /**
     * @return string
     * 生成盐
     */
    protected function generateSalt(){
        $str = '1234567890qwertyuiopasdfghjklzxcvbnm';
        $salt = substr(str_shuffle($str),10,6);
        return $salt;
    }

    /**
     * 查找管理员信息,并做分页
     * @param $size
     * @return array
     */
    public function selectAdmin($size){
        $count = $this->count();
        $pages = new Page($count,$size);

        $data = $this
            ->limit($pages->firstRow,$pages->listRows)
            ->select();
        $page = $pages->show();
        return [$data,$page];
    }

    /**
     * 查找管理员信息,并找到对应角色,拼接好数据传回
     * @param $id
     * @return mixed
     */
    public function findAdmin($id){
        $row = $this->find($id);
        //查找对应角色
        $role_ids = M('AdminRole')->where(['admin_id' => $id])->getField('role_id',true);
        $row['role_ids'] = json_encode($role_ids);
        return $row;
    }

    /**
     * 新增管理员,保存角色到关联表
     * @return bool|string
     */
    public function addAdmin(){
        $this->data['password'] = md5($this->data['password'].$this->data['salt']);
        $id = $this->add();

        //得到角色数据,拼接数据保存到AdminRole关联表中
        $role_ids = I('post.role_id');
        if(empty($role_ids)){
            return true;
        }
        $data = [];
        foreach($role_ids as $role_id){
            $data[] = [
                'admin_id' => $id,
                'role_id' => $role_id
            ];
        }
        return M('AdminRole')->addAll($data);
    }

    /**
     * 修改管理员,并且修改对应的角色
     * @param $id
     * @return bool|string
     */
    public function saveAdmin($id){
        $this->save();

        //删除之前的角色数据
        M('AdminRole')->where(['admin_id' => $id])->delete();
        //储存新角色数据
        $role_ids = I('post.role_id');
        if(empty($role_ids)){
            return true;
        }
        $data = [];
        foreach($role_ids as $role_id){
            $data[] = [
                'admin_id' => $id,
                'role_id' => $role_id
            ];
        }
        return M('AdminRole')->addAll($data);
    }

    /**
     * 修改密码
     * @param $id
     * @return bool
     */
    public function savePass($id){
        $oldPassword = I('post.oldpassword');
        $data = $this->where(['id' => $id])->find();
        $pass = md5($oldPassword.$data['salt']);
        if($pass !== $data['password']){
            $this->error = '旧密码输入错误';
            return false;
        }
        return true;
    }
}