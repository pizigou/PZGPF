<?php

class Framer{
    
    /**
     * 根据module 和action 调用module 的action 方法，可被多入口程序调用
     * @param type $module 模块
     * @param type $action 方法
     */
    public static function dispatch($module, $action)
    {
        global $Config;
        // 执行前置hook
        self::hookModuleAction($module, $action);
        $r = self::runModuleAction($module, $action);
        // 执行后置hook
        self::hookModuleAction($module, $action, FALSE);
        
        return $r;
    }
    
    /**
     * 外部调用入口
     */
    public static function run()
    {
        global $Config;
        $module = $Config['module']['alias'];
        $action = $Config['action']['alias'];
        
        if (!isset($_REQUEST[$module])) $module = $Config['module']['default'];
        else $module = $_REQUEST[$module];
        
        if (!isset($_REQUEST[$action])) $action = $Config['action']['default'];
        else $action = $_REQUEST[$action];
        
        if (!empty($module) && $module != "") {
            return self::dispatch($module, $action);
        }
    }
    
    /**
     * 执行指定的模块和方法
     * 
     * @param string $module
     * @param string $action
     * @return boolean|mixed
     */
    public static function runModuleAction($module, $action)
    {
        global $Config;
        
        $module = ucfirst($module);
        PackLoader::loadeModule($module);
        
        $m = new $module;
        if (is_object($m)) {
            $prefix = $Config['action']['prefix'];
            if (is_null($action) || empty($action)) $action = $Config['action']['default'];
            
            $method = $prefix . ucfirst($action);
            if (!empty ($action) && method_exists($m, $method)) {
                return $m->$method();
            }
        }
        
        return FALSE;
    }
    
    /**
     * 可以对指定模块和方法进行运行和运行的拦截
     * 
     * @global array $Config
     * @param string $module
     * @param string $action
     * @param boolean $isPrefix 
     */
    protected static function hookModuleAction($module, $action, $isPrefix = TRUE)
    {
        global $Config;
        
        if (is_array($Config['module']['hook_list']) && !empty($Config['module']['hook_list'])) {
            foreach ($Config['module']['hook_list'] as $v) {
                $r = FALSE;
                if ($isPrefix) $r = $v['prefix'];
                else $r = $v['suffix'];
                if ($r && !empty($v['module_match']) && preg_match($v['module_match'], $module)) { // 首先要匹配module
                    $r = TRUE;
                    if (!empty($v['action_match'])) {
                        if (!preg_match($v['action_match'], $action)) { // 如果发现action 也需要匹配
                            $r = FALSE;
                        }
                    }
                    if ($r && isset($v['module']) && isset($v['action'])) {
                        self::runModuleAction ($v['module'], $v['action']);
                    }
                }
            }
        }
    }
    
}
?>
