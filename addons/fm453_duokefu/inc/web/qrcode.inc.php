<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 二维码关联设置保存（更新方式，写覆盖）
 */
 defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$_W['page']['title'] = '二维码关联设置';
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'qrcode';
$pindex = max(1, intval($_GPC['page']));
$psize = 20;
$sql = "SELECT * FROM" . tablename('qrcode') ." WHERE `uniacid` = {$_W['uniacid']} LIMIT ". ($pindex - 1) * $psize . ',' . $psize;
$total = pdo_fetchcolumn( "SELECT COUNT(id) FROM" . tablename('qrcode') ." WHERE `uniacid` = {$_W['uniacid']} ");
$qrcodes = pdo_fetchall($sql);
$pager = pagination($total, $pindex, $psize);
foreach($qrcodes as $key => &$qrcode){
	$qid = $qrcode["id"];
	$sql = "SELECT * FROM" . tablename('fm453_duokefu_qrandfan') ." WHERE  `uniacid` = {$_W['uniacid']}  AND `qrcodeid` = {$qid} ";
	$qrdetail = pdo_fetch($sql);
	$qrcode["keyid"]=$qrdetail["id"];
	if(empty($qrdetail)) {
		$qrdetail=array(
			"uniacid" => $_W['uniacid'],
			"qrcodeid"=>$qrcode['id'],
			"qrcodename"=>$qrcode['name']
		);
		pdo_insert('fm453_duokefu_qrandfan', $qrdetail);
		$qrcode["keyid"]=pdo_insertid('fm453_duokefu_qrandfan', $qrdetail);
	}
	$qrcode["openid"]=$qrdetail["openid"];
	$qrcode["key"]=$key;
	$qrcode["ischecked"]=$qrdetail["ischecked"];
	$qrcode["isavailable"]=$qrdetail["isavailable"];
}
//开始保存
if(checksubmit()) {
	$sql = "SELECT COUNT(id) FROM" . tablename('qrcode') ." WHERE `uniacid` = {$_W['uniacid']} LIMIT ". ($pindex - 1) * $psize . ',' . $psize;
	$column = pdo_fetchcolumn($sql);
				//保存编辑后的数据
				for($i=0;$i<$column;$i++) {
					$keyid = $_GPC['keyid_'.$i];
				$saveItem[$i] = array();
				$saveItem[$i]['openid']=$_GPC['openid_'.$i];
				$saveItem[$i]['qrcodeid']=$_GPC['qrcodeid_'.$i];
				$saveItem[$i]['ischecked']=$_GPC['ischecked_'.$i];
				$saveItem[$i]['isavailable']=$_GPC['isavailable_'.$i];
				pdo_update('fm453_duokefu_qrandfan', $saveItem[$i], array('id' =>$keyid));
			}
			message('二维码关联修改已经保存',$this->createWebUrl('qrcode'),'success');
	}
include $this->template('web/qrcodes');