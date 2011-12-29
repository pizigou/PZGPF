<?php
/**
 * 主模块
 */
class App extends Module{
    
    /**
     * 上传第一页面展示
     */
    public function actionShow() 
    {
        $view = $this->getView();
        
		$helloStr = "Hello, World";

		$view->assign("helloStr", $helloStr);

		$view->display('index.html');
    }
  
}
?>
