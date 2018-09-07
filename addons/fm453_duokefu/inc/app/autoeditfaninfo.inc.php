<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-编辑用户信息
 */
		global $_GPC, $_W;
		$openid = $_GPC['openid'];
		//$fanid = $_GPC['fanid'];
		$sql = "select uid from ".tablename('mc_mapping_fans')." where openid='{$_GPC['openid']}' and uniacid='{$_W['uniacid']}' ";
		$_GPC['uid'] = pdo_fetchcolumn($sql);
		$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']}";
		if(pdo_fetchall($sql)){
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid={$_W['uniacid']} and is_show=1 and is_edit=1";
		}else{
			$sql = "select * from ".tablename('fm453_duokefu_fanslistkey')." where uniacid=0 and is_show=1 and is_edit=1";
		}

		$column = pdo_fetchall($sql);
		foreach($column as $key => $value){
			if(isset($_GPC[$value['column_name']])){
				$data[$value['column_name']] = $_GPC[$value['column_name']];
			}
		}

		pdo_begin();
		pdo_update('mc_members',$data,array("uid" => $_GPC['uid']));
		$sql = "select * from ".tablename('fm453_duokefu_fans_log')." where uid={$_GPC['uid']} limit 1";
		pdo_fetch($sql);
		$inserArr['create_time'] = time();
		$inserArr['uid'] = $_GPC['uid'];
		$inserArr['kefu_name'] = 'system';
		if(!pdo_fetch($sql)){
			$sql = "select * from ".tablename('mc_members')." where uid={$_GPC['uid']} limit 1";
			$old_member = pdo_fetch($sql);
			foreach($old_member as $key => $value){
				$inserArr[$key] = $value;
			}
			pdo_insert('fm453_duokefu_fans_log', $inserArr);
		}
		foreach($data as $key => $value){
			$inserArr[$key] = $value;
		}
		$inserArr['kefu_name'] = $_SESSION['kefu'];
		pdo_insert('fm453_duokefu_fans_log', $inserArr);
		pdo_commit();
		message('客户资料更新成功！',$this->createMobileUrl('plugin'), 'success');