﻿<?php 
//session_start();
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
//error_reporting(E_ALL); 
//ini_set('display_errors', true);
//ini_set('display_errors',1);            //错误信息
//ini_set('display_startup_errors',1);    //php启动错误信息
//error_reporting(-1);                    //打印出所有的 错误信息
date_default_timezone_set("PRC");   //系统使用北京时间

define('ALL_PS','WEBA');

define('DBHOST', '127.0.0.1');
define('DBNAME', 'jol'); //数据库名称
define('DBUSER', 'root'); //数据库用户名
define('DBPWD', 'hustoj1234!'); //数据库密码
define('DBPREFIX', '');
define('DBCHARSET', 'utf8');
define('CONN', '');
define('TIMEZONE', 'Asia/Shanghai');

$db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPWD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query('SET NAMES utf8;');


function inject_check($sql_str) { //防止注入
    $check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i', $sql_str);
    if ($check) {
        return 202; //疑似恶意代码
    } else {
        return $sql_str;
    }
}
function pwGen($password,$md5ed=False)
{
    if (!$md5ed) $password=md5($password);
    $salt = sha1(rand());
    $salt = substr($salt, 0, 4);
    $hash = base64_encode( sha1($password . $salt, true) . $salt );
    return $hash;
}
