<?php
/**
 * 多客服插件模块变量自定义
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 *说明：模块自定义变量集。
 */
 defined('IN_IA') or exit('Access Denied');
 define("AUTHOR",'Fm453'); 
if(!function_exists('check_author')) {
	function check_author($author = '') {
		global $_W;
		if (empty($author)) {
			return "";
		}
		if (!empty($author)) {
			if ($author=='fm453') {
					return $author;
			}else {
			$author='程序不完整，请联系作者';
			return 'help!';
			}
		}
	}
}