<?php


namespace Admin\Logic;

class DbMysqlLogic implements DbMysqlInterface
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function query($sql, array $args = array())
    {
        // TODO: Implement query() method.
//        echo __METHOD__.'<br>';
//        dump(func_get_args());
//        echo '<hr>';
        $args = func_get_args();
        $tmpSql = $this->_createSql($args);
        //execute方法,执行一条sql语句,第二参数不传默认false返回一条,true返回所有
        return M()->execute($tmpSql);
    }

    public function insert($sql, array $args = array())
    {
        // TODO: Implement insert() method.
//        echo __METHOD__.'<br>';
//        dump(func_get_args());
//        echo '<hr>';
        $args = func_get_args();
        //获取sql语句
        $sql = $args[0];
        //获取表名
        $table_name = $args[1];
        $sql = str_replace('?T',$table_name,$sql);
        //获取参数
        $params = $args[2];
        $tmp_sql = [];
        foreach($params as $keys=>$values){
            $tmp_sql[] = $keys.'="'.$values.'"';
        }
        //用,将参数拼接起来
        $tmp_sql = implode(',',$tmp_sql);
        //替换sql语句中的相应字符
        $sql = str_replace('?%',$tmp_sql,$sql);
        //执行sql语句
        $res = M()->execute($sql);
        //返回最后插入的数据的id
        return M()->getLastInsID();
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
//        echo __METHOD__.'<br>';
//        dump(func_get_args());
//        echo '<hr>';
        //获取实参列表
        $args = func_get_args();
        $tmpSql = $this->_createSql($args);
        //获取结果集,二维数组
        return M()->query($tmpSql);
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function getRow($sql, array $args = array())
    {
        // TODO: Implement getRow() method.
//        echo __METHOD__.'<br>';
//        dump(func_get_args());
//        echo '<hr>';
        $args = func_get_args();
        $tmpSql = $this->_createSql($args);
        $res = M()->query($tmpSql);
        //获取第一行记录
        return array_shift($res);
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo __METHOD__.'<br>';
        dump(func_get_args());
        echo '<hr>';
    }

    public function getOne($sql, array $args = array())
    {
        // TODO: Implement getOne() method.
//        echo __METHOD__.'<br>';
//        dump(func_get_args());
//        echo '<hr>';
        $args = func_get_args();
        $tmpSql = $this->_createSql($args);
        $res = M()->query($tmpSql);
        //获取第一行记录的一列记录
        return array_shift(array_shift($res));

    }

    /**
     * @param array $args
     * @return string
     * 拼接sql语句
     */
    private function _createSql(array $args){
        $sql = array_shift($args);
        //通过占位分割sql语句
        $sql = preg_split('/\?[FTN]/',$sql);
        //删除sql结构数组中的多余元素
        array_pop($sql);
        //拼接sql语句
        $tempSql = '';
        foreach($sql as $keys => $value){
            $tempSql .= $value.$args[$keys];
        }
        return $tempSql;
    }
}