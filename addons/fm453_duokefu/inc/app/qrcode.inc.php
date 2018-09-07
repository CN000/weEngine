<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-调用二维码数据
 */
global $_GPC,$_W;
checkauth();
$_W['page']['title'] = '二维码扫描情况统计';
	$openid = $_GPC['openid'];
	if (empty($openid)){
		$openid = $_W['openid'];
	}
	$sql = "SELECT * FROM " . tablename('fm453_duokefu_qrandfan') ." WHERE  uniacid = {$_W['uniacid']}  AND  openid LIKE '%{$openid}%' ";
	$qrcode =pdo_fetch($sql);
	if(empty($qrcode)) {
		message("您还没有关联指定的二维码","","info");
		exit();
	}else{
			if($qrcode['ischecked']!=1) {
		message("您的二维码关联已暂停","","info");
		exit();
	}
		if($qrcode['isavailable']==1) {
			load()->func('tpl');
			$uniacid= $_W['uniacid'];
			$qid=$qrcode['qrcodeid'];
			$qrcodeinfo =pdo_fetch("SELECT * FROM ".tablename('qrcode')." WHERE uniacid = :aid AND id = :qid", array(':aid' => $uniacid, ':qid' => $qid));
			//print_r($qrcodeinfo);
			$model =array(
				"1"=>"临时",
				"2"=>"永久"
			);
			$qrcodeinfo['model']=$model[$qrcodeinfo['model']];
			$row = pdo_fetchall("SELECT openid, type, createtime FROM ".tablename('qrcode_stat')." WHERE uniacid = :aid AND qid = :qid", array(':aid' => $uniacid, ':qid' => $qid));
			$type=array(
					"1"=>"关注",
					"2"=>"扫描"
				);
			//扫码关注人数
			$type1count = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('qrcode_stat')." WHERE uniacid = :aid AND qid = :qid AND type=1", array(':aid' => $uniacid, ':qid' => $qid));
			//总扫描人数
			$typecount = pdo_fetchcolumn("SELECT count(openid) FROM ".tablename('qrcode_stat')." WHERE uniacid = :aid AND qid = :qid ", array(':aid' => $uniacid, ':qid' => $qid));
			foreach($row as $key=>&$items){
				$row[$key]['qrcodename']=$qrcodeinfo['name'];
				$items['type']=$type[$items['type']];
				$items['createtime'] = date('Y-m-d H:i:s',$items['createtime']);
				$fanopenid=$items['openid'];
				$condition = 'WHERE';
				$condition	.= '`uniacid` =:uniacid';
				$condition .= " AND openid LIKE '%{$fanopenid}%'";
				$sql = 'SELECT * FROM ' . tablename('mc_mapping_fans') . $condition;
				$params = array();
				$params[':uniacid'] = $_W['uniacid'];
				$faninfo = pdo_fetch($sql, $params);
				$fanid = $faninfo['uid'];
				$isfollow = array (
					'0' => array(
						'css' => 'danger',
						'time' => date('Y-m-d H:i:s',$faninfo['unfollowtime']),
						'title' => '取消时间',
						'status' => '已经取消'
					),
					'1' => array(
						'css' => 'danger',
						'time' => date('Y-m-d H:i:s',$faninfo['followtime']),
						'title' => '关注时间',
						'status' => '已关注'
					)
				);
				$faninfo['follow']=!empty($faninfo['follow'])?$faninfo['follow']:1;
				$faninfo['isfollow'] = $isfollow[$faninfo['follow']];
				$row[$key]['faninfo']=$faninfo;

				$sqlmc = 'SELECT * FROM ' . tablename('mc_members') ."WHERE `uniacid` =:uniacid AND `uid` LIKE  '%{$fanid}%' ";
				$memberinfo = pdo_fetch($sqlmc, $params);
				$gender = array (
					'0' => array('css' => 'default', 'name' => '未知'),
					'1' => array('css' => 'danger','name' => '男'),
					'2' => array('css' => 'info', 'name' => '女'),
				);
				$memberinfo['gender'] =$gender[$memberinfo['gender']]['name'];
				$memberinfo['createtime'] = date('Y-m-d H:i:s',$memberinfo['createtime']);
				if(!empty($memberinfo['birthday'])) {
					$memberinfo['birthday'] = date('Y-m-d H:i:s',$memberinfo['birthday']);
				}else {
					$memberinfo['birthday'] ="未填写";
				}
				$row[$key]['memberinfo']=$memberinfo;
				//扫码统计时去除已经取消关注的粉丝（如果粉丝最终取消了，则该粉丝openid将从统计中踢除; 并将该次扫码者的openid用空值替换至统计数组中)
					$uniques['openid'][$key]=$items['openid'];
				if($faninfo['follow']==0){
					$uniques['openid'][$key]='';
				}
			}
			//使用array_filter()函数去除空值
				$uniques['openid']=array_filter($uniques['openid']);
				//去除扫码重复值（同一人多次扫描时，只计算为一次)
				$unique = array_unique($uniques['openid']);
				//print_r($unique);
				$unique_count=count($unique);
		}else {
			message("该功能通道暂时关闭，如有疑问，请联系您的客服专员","","info");
		}
	}
include $this->template('qrcode');