<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends Model
{
    protected $_validate = array(
        [],
    );

    protected $_auto = array(
        ['inputtime','time',1,'function'],
        ['sn','calc_cn',1,'callback'],
    );

    protected function calc_cn(){
        $sn = $this->data['sn'];
        //如果货号没有被输入,则自动生成货号
        if(empty($sn)){
            $day = date('Ymd');
            $goods_count_model = M('GoodsDayCount');
            $count = $goods_count_model->where(['day' => $day])->getField('count');
            //如果没有数据说明是今天的第一条数据
            if(!$count){
                $count = 1;
                $data = array(
                    'day' => $day,
                    'count' => $count,
                );
                $goods_count_model->add($data);
            }else{
                //不是第一个则执行更新操作
                $count++;
                $goods_count_model->where(['day' => $day])->setInc('count',1);
            }
            $sn = 'SN'.$day.str_pad($count,5,'0',STR_PAD_LEFT);
        }
        return $sn;
    }

    /**
     * 根据搜索条件查询数据并做分页
     * @param $where
     * @param $size
     * @return array
     */
    public function selectAllData($where,$where2,$size){
        //促销条件拼接
        if(!empty($where2)){
            $goods_id = M('GoodsToProm')->field('goods_id')->where($where2)->group('goods_id')->select();
            $array = array_column($goods_id,'goods_id');
            $where['goods.id'] = ['in',$array];
        }
        //分页处理
        $count = $this
            ->where($where)
            ->count();
        $pages = new Page($count,$size);
        //商品查询
        $data = $this
            ->field('goods.*, brand.name as brand_name, goods_category.name as category_name')
            ->join('left join brand on goods.brand_id = brand.id')
            ->join('left join goods_category on goods.goods_category_id = goods_category.id')
            ->where($where)
            ->order('sort')
            ->limit($pages->firstRow,$pages->listRows)
            ->select();
        //查询促销活动
        $prom = M('GoodsToProm')
            ->field('goods_to_prom.goods_id,goods_promotion.prom_type')
            ->join('left join goods_promotion on goods_to_prom.prom_id = goods_promotion.id')
            ->select();
        $page = $pages->show();
        return array($data,$prom,$page);
    }

}