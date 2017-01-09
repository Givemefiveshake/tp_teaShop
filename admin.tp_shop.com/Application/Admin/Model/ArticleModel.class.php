<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class ArticleModel extends Model
{
    /**
     * @var bool
     * 开启自动验证功能,批量验证
     */
    protected $patchValidate = true;
    protected $_validate = array(
        ['name','require','文章标题必填!'],
    );

    /**
     * @var array
     * 开启自动完成功能
     */
    protected $_auto = array(
        ['inputtime','time',1,'function'],
    );


    /**
     * $size传入每页条数
     * @return array
     * 连表查询文章数据和分类数据,并做分页
     * 返回索引数组,第一个分页,第二个为要显示的数据
     */
    public function getPageResult($size){
        $count = $this->where(['status' => ['gt',-1]])->count();
        $pages = new Page($count,$size);

        $rows =  $this
            ->join('left join article_category ON article.article_category_id = article_category.category_id')
            ->where(array(
                'article.status' => ['gt',-1],
            ))
            ->order('article.sort')
            ->limit($pages->firstRow,$pages->listRows)
            ->select();
        $page = $pages->show();
        $data = [$page,$rows];
        return $data;
    }

    /**
     * 得到article表.article_detail表中的数据返回,做编辑回显
     */
    public function getArticleData($id){
        $rows =  $this
            ->join('left join article_detail ON article.id = article_detail.article_id')
            ->where(array(
                'article.id' => $id,
            ))
            ->find();
        return $rows;
    }
}