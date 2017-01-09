<?php


namespace Home\Model;


use Common\Helper\Page;
use Think\Model;

class GoodsModel extends Model
{
    /**
     * 查询商品并做分页
     * @param $condition
     * @return array
     */
    public function getPageData($condition){
        //统计个数
        $count = M('Goods')
            ->where([
                'is_on_sale' => 1,
                'status' => 1,
                'goods_category_id' => $condition
            ])
            ->count();
        //分页
        $pages = new Page($count,C('PAGE.SIZE'));
        $pages->setConfig('theme', C('PAGE.THEME'));
        $page = $pages->show();
        //查出分页数据
        $data = D('Goods')->where(['goods_category_id' => $condition])
            ->limit($pages->firstRow,$pages->listRows)->select();
        return [
            'page' => $page,
            'data' => $data,
        ];
    }
}