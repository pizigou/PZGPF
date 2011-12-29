<?php

class PackLoader{
    
    public static function autoload($class_name)
    {
        global $Config;
        
        $support_ext = $Config['core']['support_ext'];
        $autoload_path = $Config['core']['autoload_path'];

        foreach ($support_ext as $ext) {
            foreach ($autoload_path as $dir) {
                $class_file = PZGPF_ROOT . $dir . $class_name . $ext;
                $r = @include_once $class_file;
                if (FALSE === $r)
                    continue;
                else break 2; // if found, exit         
            }
        }
        //echo "class " . $name . " <br />\r\n";
    }
    
    /**
     * 全局初始化方法
     */
    public static function init()
    {
//        $include_path = get_include_path();
//        $include_path .= PATH_SEPARATOR  . PZGPF_ROOT . 'core';
//        $include_path .= PATH_SEPARATOR  . PZGPF_ROOT . 'lib';
//        set_include_path($include_path);
        
        if (!spl_autoload_register('PackLoader::autoload')) die("Error " . __FILE__ . ":" . __LINE__);
    }
    
    /**
     *
     * @global type $Config
     * @param type $module 模块名
     * @return string 模块名
     */
    public static function loadeModule($module)
    {
        global $Config;
        
        $module_file = $Config['module']['root'] . '/' . $module . ".php";
        $r = @include_once $module_file;
        if (FALSE === $r) die("Error: module " . $module . " can not found!");  
    }
}

?>