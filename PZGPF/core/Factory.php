<?php
/**
 * 装配各种实例
 */
class Factory{
    
    /**
     * 链中的实例列表
     * @var Object
     */
    private static $instance_list = null;
    
    /**
     * 保存具体实现类名的字典
     * @var array
     */
    private static $class_dict = null;
    
    private $handle = null;
    
    private function __construct($type, $key)
    {
        if (is_array(self::$class_dict) && array_key_exists($type, self::$class_dict) && array_key_exists($key, self::$class_dict[$type])) {
            $this->handle = new self::$class_dict[$type][$key];
        }
    }
    
    /**
     * 单例方法，返回Factory对象的实力
     * @param mixed $type
     * @param mixed $key
     * @return Object
     */
    public static function getInstance($type, $key)
    {
        if (!is_array(self::$instance_list)) {
            self::$instance_list = array();
        }
        if (!isset(self::$instance_list[$type])) {
            self::$instance_list[$type] = array();
        }
        if (!isset(self::$instance_list[$type][$key])) {
            self::$instance_list[$type][$key] = new Factory($type, $key);
        }
        return self::$instance_list[$type][$key];
    }
    
    /**
     * 注册对象到链中
     * @param type $key
     * @param type $class 
     */
    public static function register($type, $key, $class)
    {
        if (!is_array(self::$class_dict)) {
            self::$class_dict = array();
        }
        if (!isset(self::$class_dict[$type])) {
            self::$class_dict[$type] = array();
        }
        self::$class_dict[$type][$key] = $class;
    }
    
    /**
     * 从链中反注册掉
     * @param type $type
     * @param type $key 
     */
    public static function unregister($type, $key)
    {
        if (is_array(self::$class_dict[$type]) && array_key_exists($key, self::$class_dict[$type])) unset(self::$class_dict[$type][$key]);
    }
    
    /**
     * 使对Factory实例的呼叫转向对具体的类实例进行呼叫
     * @param type $fun_name
     * @param type $fun_arg_array 
     */
    public function __call($fun_name, $fun_arg_array)
    {
        if (!is_null($this->handle)) { // 当使用__call的方式的时候，method_exists 方法不能正确返回
            //call_user_func_array(array($this->db_handle, $fun_name), $fun_arg_array);
            return call_user_method_array($fun_name, $this->handle, $fun_arg_array);
        }
    }
    
    public function __destruct() 
    {
        $this->handle = null;
    }
}
?>
