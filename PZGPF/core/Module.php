<?php
abstract class Module{

    public function __construct()
    {
    }

    /**
     * 得到数据库实例
     * @return Database Object  
     */
    public function getDB()
    {
        return Factory::getInstance('db', 'mysql');
    }

    /**
     * 得到模版对象
     */
    public function getView()
    {
        return Factory::getInstance('view', 'smarty');
    }
    
    public function actionShow()
    {
        echo "Hello World!";
    }
}
?>