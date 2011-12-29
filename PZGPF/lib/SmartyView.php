<?php
/**
 * 基于Smarty3 的模版引擎包装
 */
require_once PZGPF_ROOT . "lib/Smarty/Smarty.class.php";

class SmartyView{
    private $handle = null;
    
    public function __construct() 
    {
        global $Config;
        
        $this->handle = new Smarty;
        $this->handle->setTemplateDir($Config['view']['smarty']['templates_dir']);
        $this->handle->setCompileDir($Config['view']['smarty']['compile_dir']);
        //$this->handle->setConfigDir('');
        $this->handle->setCacheDir($Config['view']['smarty']['cache_dir']);
        $this->handle->left_delimiter = $Config['view']['smarty']['left_delimiter'];
        $this->handle->right_delimiter = $Config['view']['smarty']['right_delimiter'];
    }
    
    public function __call($fun_name, $fun_arg_array) 
    {
        if (!is_null($this->handle)) {
            //die(var_dump($this->handle, $fun_name, $fun_arg_array));
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
