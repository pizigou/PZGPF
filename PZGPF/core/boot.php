<?php
define('PZGPF_ROOT', str_replace('\\', '/', str_replace(basename(dirname(__FILE__)), "", __DIR__)));

//error_reporting(E_ALL ^ E_NOTICE);
require_once(PZGPF_ROOT . '/core/Config.php');
require_once(PZGPF_ROOT . '/core/Loader.php');

PackLoader::init();

Factory::register('db', 'mysql', 'DBMySQL');
//Factory::register('view', 'twig', 'TwigView');
Factory::register('view', 'smarty', 'SmartyView');
?>