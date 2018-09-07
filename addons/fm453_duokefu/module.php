<?php
/**
 * 多客服插件模块定义
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 */
defined('IN_IA') or exit('Access Denied');
class Fm453_duokefuModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
		global $_W,$_GPC;
		$setting = $_W['account']['modules'][$this->_saveing_params['mid']]['config'];
		include $this->template('rule');
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0

		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
		global $_GPC, $_W;
		if(!empty($_GPC['title'])) {
			$data = array(
				'title' => $_GPC['title'],
				'description' => $_GPC['description'],
				'picurl' => $_GPC['thumb-old'],
				'url' => create_url('mobile/module/qrcode', array('name' => 'fm453_duokefu', 'uniacid' => $_W['uniacid'])),
			);
			if (!empty($_GPC['thumb'])) {
				$data['picurl'] = $_GPC['thumb'];
				file_delete($_GPC['thumb-old']);
			}
			$this->saveSettings($data);
		}
		return true;
	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		load()->func('tpl');
		load()->model('mc');
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
		    if (empty($settings['shouquan']['suip'])){
		    $settings['shouquan']['suip']=gethostbyname($_SERVER['HTTP_HOST']);
		    }
		    if (empty($settings['shouquan']['sudomin'])){
		    $settings['shouquan']['sudomin']=$_SERVER['HTTP_HOST'];
		    }
		    if (empty($settings['shouquan']['sufm453code'])){
		    $settings['shouquan']['sufm453code']="localhost";
		    }
		    if (!empty($settings['shouquan']['sufm453code'])){
		    $isread='readonly="true"';
		    }else{
		     $isread='';
		    }
		include $this->template('web/setting');
		}
		if ($operation == 'onandoff') {
		include $this->template('web/onandoff');
		}
		if ($operation == 'paramssets') {
			include $this->template('web/paramssets');
		}
		if ($operation == 'menusset') {
			include $this->template('web/menusset');
		}
		if ($operation == 'extset') {
			include $this->template('web/extset');
		}
		if ($operation == 'safeset') {
			include $this->template('web/safeset');
		}
		if ($operation == 'tplset') {
			include $this->template('web/fortplset');
		}
		if ($operation == 'fanslistkey') {
			//加载会员表列名字段数据
			$sql = "select * from " . tablename("mc_members") . " where uniacid={$_W['uniacid']}";
			$m_column =pdo_fetch($sql);	//从会员表中读第一条数据出来，用于下一下的数组分拆组合
			//print_r($m_column);
			$n_column =	array_rand($m_column,count($m_column));	//使用array_rand() 函数从源数组中随机选出多个元素，并返回键名，组成新数组；只选一个元素时，返回键值；
			//print_r($n_column);
			//现在开始对新得到的列名数组进行结构的数组化操作，将column_name作为键名
			$column =array();
			foreach ($n_column as $key => $n_value) {
				$column[$key]['column_name'] = $n_value;
			}
			//print_r($column);
			unset($sql);
			//设置过的字段（全局默认或者用户后设置）
					//从设定好的粉丝数据字段表中挑出对应的字段，生成数组$f_column
			$sql = "select * from " . tablename("fm453_duokefu_fanslistkey") . " where uniacid={$_W['uniacid']}";
			$f_column = pdo_fetchall($sql);
			if (!$f_column) {
				$sql = "select * from " . tablename("fm453_duokefu_fanslistkey") . " where uniacid=0";
				$f_column = pdo_fetchall($sql);
				$default_column = pdo_fetchall($sql);
			}
			//print_r(count($f_column));
			//print_r($f_column);
				//将模块配置的粉丝数据字段以字段名column_name为键名，重新汇入数组$fanslistkeys，方便与$column数组对应
			$fanslistkeys=array();
			foreach ($f_column as $key => $f_value) {
				$fanslistkeys[$f_value['column_name']] = $f_value;
			}
			//全局的默认数据
				$sql = "select * from " . tablename("fm453_duokefu_fanslistkey") . " where uniacid=0";
				$default_column = pdo_fetchall($sql);
			$default_fanslistkeys=array();
			foreach ($default_column as $key => $def_value) {
				$default_fanslistkeys[$def_value['column_name']] = $def_value;
			}
			//print_r(count($fanslistkeys));
			//print_r($fanslistkeys);
				//对有对应设置项的键进行重写，对应依据为$column数组中的column_name键与$fanslistkeys中同名键
			foreach ($column as $key => $value) {
				$column[$key]['column_show_name'] = $fanslistkeys[$value['column_name']]['column_show_name'];
				$column[$key]['show_order'] = $fanslistkeys[$value['column_name']]['show_order'];
				$column[$key]['is_show'] = $fanslistkeys[$value['column_name']]['is_show'];
				$column[$key]['is_edit'] = $fanslistkeys[$value['column_name']]['is_edit'];
				$column[$key]['id'] = $fanslistkeys[$value['column_name']]['id'];
				$column[$key]['key']=$key;	//用于对应页面中的表单填写项，前台引用部分禁止删除，否则数据操作无效。
			}
			$count_column=count($column);
			//print_r($count_column);
				include $this->template('web/fanslistkey');
		}
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//保存参数设置页的数据$cfg；目前本处设置的仅是常规项，消息模板也保存在模块设置中，调整时需注意进模板消息设置页中作相应调整
			//字段验证, 并获得正确的数据$dat
			$this->saveSettings($dat);
			message('数据保存成功','referer','success');
		}
		//这里来展示设置项表单
	}

}