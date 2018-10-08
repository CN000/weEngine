<?php

define('IN_SYS', true);
require '../framework/bootstrap.inc.php';
require IA_ROOT . '../web/common/bootstrap.sys.inc.php';

global $_W;


echo "Line:".__LINE__."\n\r";

$sql = 'select * from ims_users where uid = 1';
$params[':username'] = 'admin';
$record = pdo_fetch($sql, $params);

echo "Line:".__LINE__."\n\r";

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
echo "Line:".__LINE__."\n\r";

$password = "{$password}-{$salt}-{$_W['config']['setting']['authkey']}";
$password = sha1($password);
echo "Line:".__LINE__."\n\r";

$sql = "update ims_users set password = '".$password."' ,salt='".$salt."' where uid=1";
$data = pdo_query($sql);
echo "Line:".__LINE__."\n\r";

echo 'ok';