<?php

/**
 * 配置文件，可外部覆盖
 */
$Config = array(
    'core'  => array (
        'support_ext'   => array('.php', '.class.php'),
        'autoload_path'  => array('core/', 'lib/')
    ),
    
    'db'    => array (
        'mysql' => array(
            'host'      => 'localhost',
            'port'      => '3306',
            'user'      => 'root',
            'password'  => '',
            'name'      => 'scanvirus',
            'charset'   => 'utf8'
        )
    ),
    
    'view'  => array (
        'twig'      => array (
            'templates_dir' => PZGPF_ROOT . '../templates',
            'cache_dir'     => PZGPF_ROOT . '../cache/templates' 
        ),
        'smarty'    => array(
            'debug' => true,
            'templates_dir' => PZGPF_ROOT . '../templates',
            'compile_dir'  => PZGPF_ROOT . '../cache/templates',
            'cache_dir'     => PZGPF_ROOT . '../cache/templates',
            'is_cache'      => true,
            'cache_time'    => 120,
            'left_delimiter'    => '<!--{',
            'right_delimiter'   => '}-->'
        )
    ),

    'module'    => array(
        'root'      => PZGPF_ROOT . '../Module',
        'default'   => 'App',
        'alias'     => 'm',
        'hook_list' => array(
            array(
                'module_match'      => '/^admin/',
                'action_match'      => '',
                'prefix'            => false,
                'suffix'            => false,
                'module'            => null,
                'action'            => null
            )
        )
    ),    
    
    'action'    => array(
        'default'    => 'show',
        'prefix'     => 'action',
        'alias'      => 'act',        
    ),
    'upload'    => array(
        'path'  => PZGPF_ROOT . "../upload"
    )
);
?>
