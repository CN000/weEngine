<?php
/**
 * 多客服插件模块程序设计
 *
 * @author fm453
 * @url http://bbs.we7.cc/thread-9741-1-1.html
 * 多客服插件页-查询微擎微商城订单功能
 */
 global $_GPC,$_W;
	$openid = $_GPC['openid'];  // (OPENID由客服助手模块主程序处理，此页自动继承)
 	$pindex = max(1, intval($_GPC['page']));//分页功能暂不可用
 	$pagename = "微商城订单";
	$psize = 3;
	$condition = 'WHERE';
	$condition .= '`weid` =:uniacid';
	$condition .= " AND from_user LIKE '%$openid%'";
	//$condition .= ' AND `deleted` = 0';
	$sqlnum = 'SELECT COUNT(*) FROM ' . tablename('shopping_order') . $condition;
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$total = pdo_fetchcolumn($sqlnum, $params);
	if ($total > 0) {
		//$limit = ' LIMIT ' . $pindex * $psize . ',' . $psize; //与分页功能关联
		$limit ='';
		$condition = 'WHERE';
		$condition .= '`weid` =:uniacid';
		$condition .= " AND from_user LIKE '%$openid%'";
		//$condition .= ' AND `deleted` = 0';
		$condition .= ' ORDER BY `createtime` DESC';
		$params = array(':uniacid' => $_W['uniacid']);
		$sql = 'SELECT * FROM ' . tablename('shopping_order') . $condition . $limit;
		//$sql = 'SELECT `o`.*, `a`.* FROM ' . tablename('shopping_order') . ' AS `o` LEFT JOIN' . tablename('mc_member_address') . ' AS `a` ON `o`.`addressid` = `a`.`id` ' . $condition . $limit;
		//官方更新后去除了地址表在订单表中的关联,采用直接显示收货地址的方式
		//
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
			$value['dispatch'] = pdo_fetchcolumn("SELECT `dispatchname` FROM " . tablename('shopping_dispatch') . " WHERE id = :id", array(':id' => $value['dispatch']));
			if ($s < 1) {
				$value['css'] = $paytype[$s]['css'];
				$value['paytype'] = $paytype[$s]['name'];
				continue;
			}
			$value['css'] = $paytype[$value['paytype']]['css'];
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
			$value['goods'] = pdo_fetchall("SELECT g.*, o.total,g.type,o.optionname,o.optionid,o.price as orderprice FROM " . tablename('shopping_order_goods') . " o left join " . tablename('shopping_goods') . " g on o.goodsid=g.id " . " WHERE o.orderid=:orderid", array(':orderid' => $value['id']));
			$item['goods'] = $value['goods'];
		}
		$return['ewei_shopping']['orders']=$list;
		$return['ewei_shopping']['pagename']="微商城订单";
	}
	//echo $return;
	//include $this->template('plugin/ewei_shopping/display');