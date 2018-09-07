<?php
/**
 * 多客服插件模块微站定义
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 */
defined('IN_IA') or exit('Access Denied');
include 'model.php'; //加载自定义的函数库
class Fm453_duokefuModuleSite extends WeModuleSite {
	//分解do***的应用入口方式
	public function __call($name, $arguments){
		global $_GPC;
		global $_W;
		$controller = 'index';
		$action ='index';

		if (empty($_GPC['do'])) {
			$_GPC['do']= 'index';
		}else{
			$controller =$_GPC['do'];
		}
		
		//路由准备
		$isWeb = stripos($name, 'doWeb') === 0;
		$isMobile = stripos($name, 'doMobile') === 0;
		//功能性插件程序 plugin文件夹中对应的插件名文件夹下的以453.php文件中//插件功能只在自动加载模式下启用，手动模式下采用文件链接方式实现
		$isAppPlugin = stripos($name, 'doMobilePlugin') === 0 && $name !=='doMobilePlugin';

		//进行路由处理
		if($isWeb || $isMobile) {
			if ($isWeb) {
				checklogin();
				if(!$_W['uniacid']){
					message("当前登陆状态已失效，请返回系统重新选择管理公众号");
				}
				$model_name = strtolower(substr($name, 5));
				$file= 'inc/web/'.$model_name.'.inc.php';
			}elseif ($isMobile) {
				$model_name = strtolower(substr($name, 8));
				$file= 'inc/app/'.$model_name.'.inc.php';

				if ($isAppPlugin) {
					$model_name = strtolower(substr($name, 14));
					$file= 'plugin/'.$model_name.'/453.php';
				}
			}

			require_once $file;	// 文件引用放在最后，以继续上面的数据与逻辑
		}else{
			trigger_error('您访问的'.$name.'链接 不存在,请联系管理员…', E_USER_ERROR);
			return false;
		}
	}

	//接收支付结果回调通知
	public function payResult($params) {
		return FM_CHECK_PAY_RESULT($params);//必须要有return
	}

//至此，主体程序结束

	//根据粉丝openid获取对应粉丝的头像等信息
	private function getFaninfo($openid){
		load()->model('mc');
		$openid=$_GPC['openid'];
		$fanid=mc_openid2uid($openid);
		$member = mc_fetch($fanid);
		$faninfo=mc_fansinfo($openid);
		$returns=array();
		$returns['member']=$member;
		$returns['faninfo']=$faninfo;
		return $returns;
	}
		//通过授权获取对应粉丝的头像信息
	private function getFanAvatar(){
		load()->model('mc');
		$openid=$_GPC['openid'];
		$faninfo=mc_fansinfo($openid);
		//$avatar=$faninfo['tag']['avatar'];
		 $avatar = '';
		if (!empty($_W['member']['uid'])) {
			$member = mc_fetch(intval($_W['member']['uid']), array('avatar'));
			if (!empty($member)) {
				$avatar = $member['avatar'];
			}
		}
		if (empty($avatar)) {
			$fan = mc_fansinfo($_W['openid']);
			if (!empty($fan)) {
				$avatar = $fan['avatar'];
			}
		}
		if (empty($avatar)) {
			$userinfo = mc_oauth_userinfo();
			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['avatar'])) {
				$avatar = $userinfo['avatar'];
			}
		}
		if (empty($avatar) && !empty($_W['member']['uid'])) {
			$avatar = mc_require($_W['member']['uid'], array('avatar'));
		}
		return $avatar;
	}

	//网页授权，粉丝及用户信息获取方法
	public function getuserinfo() {
		global $_W;
		load() -> model('mc');
		$userinfo = mc_oauth_userinfo();
	}
	
	public function getfansinfo($openid) {
		global $_W;
		load() -> model('mc');
			$uid = mc_openid2uid($openid);
			$result = mc_fetch($uid, array('credit1', 'credit2','avatar','nickname'));
			$result['nickname'] = $profile['nickname'];
			$result['avatar'] = $profile['avatar'];
		return $result;
	}
}