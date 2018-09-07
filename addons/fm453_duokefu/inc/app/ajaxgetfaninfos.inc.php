<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-AJAX加载粉丝信息
 */
		global $_GPC, $_W;
		$openid = $_GPC['openid'];		
		$uniacid = $_W['uniacid'];
		$sql = "select m.*,mf.openid from ".tablename('mc_members')." m left join ".tablename('mc_mapping_fans')." mf on mf.uid=m.uid where mf.openid='{$openid}'  AND mf.uniacid='{$uniacid}'";
		$return['member'] = pdo_fetch($sql);
		$return['member']['createtime'] = date('Y-m-d H:i:s',$return['member']['createtime']);
		$return['member']['followtime'] = date('Y-m-d H:i:s',$return['member']['followtime']);
		$return['member']['birthday'] = date('Y-m-d H:i:s',$return['member']['birthday']);
		$gender = array (
			'0' => array('css' => 'default', 'name' => '未知'),
			'1' => array('css' => 'danger','name' => '男'),
			'2' => array('css' => 'info', 'name' => '女'),			
		);
		$return['member']['gender'] =$gender[$return['member']['gender']]['name'];	
		//读取用户信息字段表,按设置的排序数大小倒序，按ID，DESC倒序（从大到小），ASC正序（从小到大）。
		$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} order by show_order DESC , id ASC";
		if(pdo_fetchall($sql)){
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} and is_show=1  order by show_order DESC , id ASC";
		}else{
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid=0 and is_show=1  order by show_order DESC , id ASC";
		}
		
		$column = pdo_fetchall($sql);
		foreach($column as $value){
			if($value['is_show']){
			$returns['member'][$value['column_name']] = $return['member'][$value['column_name']];
			}
		}
	echo json_encode($returns);
