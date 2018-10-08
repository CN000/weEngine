<?php

define('IN_SYS', true);
require '../framework/bootstrap.inc.php';
require IA_ROOT . '../web/common/bootstrap.sys.inc.php';
global $_W;



$sql = 'select * from ims_users where uid = 1';
$params[':username'] = 'admin';
$record = pdo_fetch($sql, $params);

// ./framework/model/user.mod.php  line:
/*

function user_hash($passwordinput, $salt) {
	global $_W;
	$passwordinput = "{$passwordinput}-{$salt}-{$_W['config']['setting']['authkey']}";

    return sha1($passwordinput);
}
 *
 */
$passwordinput = 'fc123123';
$salt = 'd95fd308';

$passwordinput = "{$passwordinput}-{$salt}-{$_W['config']['setting']['authkey']}";
$data = sha1($passwordinput);

$sql2 = "update ims_users set password = '$data' ,salt='d95fd308' where uid=2";
$data = pdo_query($sql2);
echo 'ok';












?>
