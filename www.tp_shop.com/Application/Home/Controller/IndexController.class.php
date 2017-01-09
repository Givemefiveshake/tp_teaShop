<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /**
     * 首页展示
     */
    public function index(){
        //展示分类
        $rows = M('GoodsCategory')->where(['level' => 2])->select();
        $this->assign('categories',$rows);
        //展示所有商品中最新商品
        if(!$goods = S('goods')){
            $goods = M('Goods')->where(['is_on_sale' => 1,'status' => 1])->order('id desc')->select();
            S('goods',$goods,300);
            echo 111;
        }
        $this->assign('goods',$goods);
        //文章分类展示
        $articleCategory = M('ArticleCategory')->select();
        $this->assign('articleCategories',$articleCategory);
        //文章展示
        $article = M('Article')->where(['status' => 1])->select();
        $this->assign('articles',$article);
        $this->display('index');
    }

    /**
     * 商品详情页
     */
    public function product(){
        $id = I('get.id');
        //商品
        $goods = M('Goods')->find($id);
        $this->assign('goods',$goods);
        //商品相册(array)
        $gallery = M('GoodsGallery')->where(['goods_id' => $id])->limit(4)->select();
        $this->assign('galleries',$gallery);
        //商品详情
        $detail = M('GoodsDetail')->find($id);
        $this->assign('detail',$detail);
        //展示分类
        $rows = M('GoodsCategory')->where(['level' => 2])->select();
        $this->assign('categories',$rows);
        //该商品所属分类
        $goodsCategory = M('GoodsCategory')->where(['id' => $goods['goods_category_id']])->getField('name');
        $this->assign('goodsCategory',$goodsCategory);
        //展示页面
        $this->display('product');
    }

    /**
     * 商品列表页
     */
    public function product_list(){
        $goods_category_id = I('get.id');
        //展示分类
        $rows = M('GoodsCategory')->where(['level' => 2])->select();
        $this->assign('categories',$rows);
        //该分类详情
        $category = M('GoodsCategory')->find($goods_category_id);
        $this->assign('categoryName',$category);
        //品牌信息
        $brand = M('Brand')->select();
        $this->assign('brands',$brand);
        //获取该分类下的所有商品
        $goods = D('Goods')->getPageData($goods_category_id);
        $this->assign('goods',$goods['data']);
        $this->assign('pages',$goods['page']);

        $this->display();
    }

    /**
     * 文章详情页
     */
    public function article(){
        $id = I('get.id');
        //展示分类
        $rows = M('GoodsCategory')->where(['level' => 2])->select();
        $this->assign('categories',$rows);
        //获取文章详情
        $article = M('Article')->where(['id' => $id,'status' => 1])->find();
        $this->assign('articleDetail',$article);
        //文章内容
        $detail = M('ArticleDetail')->find($id);
        $this->assign('detail',$detail);

        $this->display();
    }
}