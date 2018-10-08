<?php

define('IN_SYS', true);
require '../framework/bootstrap.inc.php';
require IA_ROOT . '../web/common/bootstrap.sys.inc.php';
global $_W;



$sql = 'select * from ims_users where uid = 1';
$params[':username'] = 'admin';
$record = pdo_fetch($sql, $params);


/*
    File: framework/model/user.mod.php  line:

    function user_hash($passwordinput, $salt)
    {
        global $_W;
        $passwordinput = "{$passwordinput}-{$salt}-{$_W['config']['setting']['authkey']}";

        return sha1($passwordinput);
    }
*/

$password = 'fc123123';
$salt     = 'd95fd308';

$password = "{$password}-{$salt}-{$_W['config']['setting']['authkey']}";
$password = sha1($password);

$sql = "update ims_users set password = '".$password."' ,salt='".$salt."' where uid=1";
$data = pdo_query($sql);

echo 'ok';