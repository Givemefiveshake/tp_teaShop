<?php


namespace Admin\Model;


use Think\Model;

class BrandModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;
    //验证规则
    protected $_validate = [
        ['name', 'require', '品牌名不能为空'],
    ];

    /**
     * @return mixed
     * 返回查出的数据
     */
    public function getPageData(){
        return $this
            ->where([
                'status' => ['gt',-1],
            ])
            ->order('sort')
            ->select();
    }
}