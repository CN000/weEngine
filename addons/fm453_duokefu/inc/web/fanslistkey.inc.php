<?php
/**
 * 客服助手模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 粉丝字段显示设置保存（更新方式，写覆盖）
 */
 defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '粉丝信息字段调用设置';
global $_GPC,$_W;	
$count_column=$_GPC['count_column'];	//从设置页获取要保存的字段项目总数
			//加载会员表列名字段数据
			$sql = "select * from " . tablename("mc_members") . " where uniacid={$_W['uniacid']}";						
			$m_column =pdo_fetch($sql);	
			$n_column =	array_rand($m_column,count($m_column));
			$column =array();
			foreach ($n_column as $key => $n_value) {				
				$column[$key]['column_name'] = $n_value;
			}
			//全局的默认字段
				$sql = "select * from " . tablename("fm453_duokefu_fanslistkey") . " where uniacid=0";
				$default_column = pdo_fetchall($sql);
			$default_fanslistkeys=array();
			foreach ($default_column as $key => $def_value) {
				$default_fanslistkeys[$def_value['column_name']] = $def_value;
			}
				//用户已经设置的字段
				$sql = "select * from " . tablename("fm453_duokefu_fanslistkey") . "  where uniacid={$_W['uniacid']}";	
				$f_column = pdo_fetchall($sql);
			$f_fanslistkeys=array();
			foreach ($f_column as $key => $f_value) {
				$f_fanslistkeys[$f_value['column_name']] = $f_value;
			}	
			//开始做保存新设置的动作
			$tips="";	//操作提示（调试用）
  foreach ($column as $key => $value) {
				$f_key=$f_fanslistkeys[$column[$key]['column_name']];
				$i=$key;				
				$column[$key]['id'] = $f_key['id'];
				//保存编辑后的数据				
				$saveItem[$key] = array();
				$saveItem[$key]['show_order']=$_GPC['show_order_'.$i];
				$saveItem[$key]['column_show_name']=$_GPC['column_show_name_'.$i];			
				$saveItem[$key]['is_show']=$_GPC['is_show_'.$i];
				$saveItem[$key]['is_edit']=$_GPC['is_edit_'.$i];
				$saveItem[$key]['uniacid']=$_W['uniacid'];
				if($f_key['id']){
					pdo_update('fm453_duokefu_fanslistkey', $saveItem[$key], array('id' =>$f_key['id']));
					//$tips .='有：ID号'.$f_key['id'].'键序列号为'.$key.'&#61;&#61;&#61;';
				}else{
					$saveItem[$key]['column_name']=$column[$key]['column_name'];
					pdo_insert('fm453_duokefu_fanslistkey', $saveItem[$key]);
					//$tips .='无：ID号'.$f_key['id'].'键序列号为'.$key.'&#61;&#61;&#61;';
				}			
		}	
		//message($tips,'referer','success');		
			message('粉丝信息表显示字段设置成功','referer','success');