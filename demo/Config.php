<?php
/**
 * 可自定义配置文件
 */
// 用户模块所在目录
$Config['module']['root'] = __DIR__ . '/Module';

// 上传文件所在目录配置
$Config['upload']['path'] = __DIR__ . "/upload";

// MYSQL 数据库配置
$Config['db']['mysql'] = array(
            'host'      => 'localhost',
            'port'      => '3306',
            'user'      => 'root',
            'password'  => '',
            'name'      => 'pzgpf',
            'charset'   => 'utf8'
        );

// 配置smarty 模版相关的
$Config['view']['smarty'] = array(
            'debug' => true,
            'templates_dir' => __DIR__ . '/templates',
            'compile_dir'  => __DIR__ .  '/cache/templates',
            'cache_dir'     => __DIR__ . '/cache/templates',
            'is_cache'      => true,
            'cache_time'    => 120,
            'left_delimiter'    => '<!--{',
            'right_delimiter'   => '}-->'
        );
?>
