<?php
/**
 * 简单分页
 *
 * @author pizigou
 */
class Page {

    private $currentPage = 0;
    private $total = 0;
    private $n = 0;

    
    /**
     *
     * @param integer $currentPage 当起页
     * @param integer $n 每页分页数
     * @param integer $total 总数
     */
    public function __construct($currentPage, $n, $total) 
    {
        //$prefixUrl = $prefix_url;
        $this->currentPage = $currentPage;
        $this->n = $n;
        $this->total = $total;
    }
    
    /**
     * 返回分页代码
     * @return string 
     */
    public function getPageStr($prefixUrl)
    {
        if ($this->currentPage == 1 && $this->total < $this->n) {
            return "";
        }
        if ($this->currentPage == 1 && $this->total >= $this->n) {
            return '<a href="' . $prefixUrl . '&p=2">下一页</a>';
        }
        
        if ($this->currentPage > 1 && $this->total < $this->n) {
            return '<a href="' . $prefixUrl . '&p=' . ($this->currentPage - 1) . '">上一页</a>';
        }
        
        if ($this->currentPage > 1 && $this->total >= $this->n) {
            $str = '<a href="' . $prefixUrl . '&p=' . ($this->currentPage - 1) . '">上一页</a>';
            $str .= "&nbsp;&nbsp;";
            $str .= '<a href="' . $prefixUrl . '&p=' . ($this->currentPage + 1) . '">下一页</a>';
            return $str;
        }
        return "";
    }
}

?>
