<?php

class DBMySQL{
	
    private $pdo_instance = null;

    public function __construct()
    {
        global $Config;
        
        $dsn = 'mysql:host=' . $Config['db']['mysql']['host'] . ';port=' . $Config['db']['mysql']['port']  . ';dbname=' . $Config['db']['mysql']['name'];
        
        $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $Config['db']['mysql']['charset'],
        ); 
        $options = null;

        $this->pdo_instance = new PDO($dsn, $Config['db']['mysql']['user'], $Config['db']['mysql']['password'], $options);

    }

    public function __call($fun_name, $fun_arg_array)
    {
        if (!is_null($this->pdo_instance)) {
            //call_user_func_array(array($this->db_handle, $fun_name), $fun_arg_array);
            return call_user_method_array($fun_name, $this->pdo_instance, $fun_arg_array);
        }
    }
}
?>