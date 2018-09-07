<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-查询人人微商城订单功能
 */
 global $_GPC,$_W;
 load()->model('mc');
	$openid = $_GPC['openid']; //OPENID由客服助手模块主程序处理，此页自动继承
			$theuserid = mc_openid2uid($openid);
			$sql = "SELECT * FROM " . tablename('mc_member_address') . " WHERE `uniacid` = :uniacid  AND `uid` = :uid  AND `isdefault` = 1 ";
			$params = array();
			$params[':uniacid']  = $_W['uniacid'];
			$params[':uid'] = $theuserid;
			$addresses = pdo_fetch($sql, $params);
			unset($params);
  $pindex = max(1, intval($_GPC['page']));	//分页功能暂不可用
	$psize = 2;
	$condition = 'WHERE';
	$condition .= '`uniacid` =:uniacid';
	$condition .= " AND `openid`=:openid";
	$condition .= ' AND `deleted` = 0';
	$sqlnum = 'SELECT COUNT(*) FROM ' . tablename('ewei_shop_order') . $condition;
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$params[':openid'] = $openid ;
	$total = pdo_fetchcolumn($sqlnum, $params);
	if ($total > 0) {
		//$limit = ' LIMIT ' . $pindex * $psize . ',' . $psize; //与分页功能关联
		$limit ='';
		$condition = 'WHERE';
		$condition .= '`uniacid` =:uniacid';
    	$condition .= " AND `openid`=:openid";
    	$condition .= ' AND `deleted` = 0';
		$condition .= ' ORDER BY `createtime` DESC';
		$params = array();
       $params[':uniacid'] = $_W['uniacid'];
	   $params[':openid'] = $openid ;
		$sql = 'SELECT * FROM ' . tablename('ewei_shop_order') . $condition . $limit;
		$list = pdo_fetchall($sql, $params);
		$pager = pagination($total, $pindex, $psize);
		$paytype = array (
			'0' => array('css' => 'default', 'name' => '未支付'),
			'1' => array('css' => 'danger','name' => '余额支付'),
			'2' => array('css' => 'info', 'name' => '在线支付'),
			'3' => array('css' => 'warning', 'name' => '货到付款')
		);
		$orderstatus = array (
			'-1' => array('css' => 'default', 'name' => '已取消'),
			'0' => array('css' => 'danger', 'name' => '待付款'),
			'1' => array('css' => 'info', 'name' => '待发货'),
			'2' => array('css' => 'warning', 'name' => '待收货'),
			'3' => array('css' => 'success', 'name' => '已完成')
		);
		foreach ($list as &$value) {
			$s = $value['status'];
			$orderid = $value['id'];
			$ordersn = $value['ordersn'];
			$value['statuscss'] = $orderstatus[$value['status']]['css'];
			$value['status'] = $orderstatus[$value['status']]['name'];
			$value['dispatch'] = pdo_fetchcolumn("SELECT `dispatchname` FROM " . tablename('ewei_shop_dispatch') . " WHERE id = :id", array(':id' => $value['dispatch']));
			if ($s < 1) {
				$value['css'] = $paytype[$s]['css'];
				$value['paytype'] = $paytype[$s]['name'];
				continue;
			}
			$value['css'] = $paytype[$value['paytype']]['css'];
			//地址信息订单表中已未关联，从系统的会员收货地址读取
			unset($value['address']);
			$value['address'] = $addresses['username']."-".$addresses['mobile']."-".$addresses['address'];
			if ($value['paytype'] == 2) {
				if (empty($value['transid'])) {
					$value['paytype'] = '支付宝支付';
				} else {
					$value['paytype'] = '微信支付';
				}
			} else {
				$value['paytype'] = $paytype[$value['paytype']]['name'];
			}
			//重命名支付方式
			if (!empty($value['transid'])){
					if ($value['transid'] == 0){
						$value['transid'] = '订单已经取消';
					} else {
						$value['transid'] = $value['transid'];
					}
			} else {
				$value['transid'] = '非微信支付订单';
			}
			//重命名微支付流水号
			$value['webpayid'] = pdo_fetch('SELECT * FROM ' . tablename('core_paylog') . ' WHERE tid = :orderid', array(':orderid' => $value['id']));	//查询支付表里的记录号plid
			$value['goods'] = pdo_fetchall("SELECT g.*, o.total,g.type,o.optionname,o.optionid,o.price as orderprice FROM " . tablename('ewei_shop_order_goods') . " o left join " . tablename('ewei_shop_goods') . " g on o.goodsid=g.id " . " WHERE o.orderid=:orderid", array(':orderid' => $value['id']));
		}
		$return['ewei_shop']['orders']=$list;
		$return['ewei_shop']['pagename']="人人商城订单";
	}
//include $this->template('plugin/ewei_shop/display');