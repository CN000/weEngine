<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<ul class="nav nav-tabs">
	<li<?php  if($op == 'display') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category',array('op' => 'display'))?>">菜单管理</a></li>
	<li<?php  if($op == 'post') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category',array('op' => 'post') )?>">添加菜单</a></li>
</ul>

<?php  if($op == 'post') { ?>
	<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">标题</label>
			<div class="col-sm-4">
			  <input type="text" name="cname" value="<?php  echo $item['name'];?>" class="form-control" placeHolder="请输入分类名称">
			</div>
		</div>
	
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">一级菜单</label>
			<div class="col-sm-4">
				<select class="form-control" name="parentid">
					<option value="0">作为一级菜单</option>
					<?php  if(is_array($categorys)) { foreach($categorys as $p) { ?>
						<option value="<?php  echo $p['id'];?>" <?php  if($item['parentid'] == $p['id']) { ?>selected="selected"<?php  } ?>><?php  echo $p['name'];?></option>
					<?php  } } ?>
				</select>
				<div class="alert alert-info" role="alert" style="margin-top:5px">最多支持三个一级菜单，超过3个只读取前三个菜单设置</div>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">链接</label>
			<div class="col-sm-4">
			  <input type="text" name="url" value="<?php  echo $item['url'];?>" class="form-control" placeHolder="请输入菜单链接">
			  <div class="alert alert-info" role="alert" style="margin-top:5px">链接需要包含 http:// 或 https://</div>
			</div>
		</div>
	  
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-10">
		    <div class="checkbox">
		      <label>
		      	<input type="checkbox" name="enabled" <?php  if(intval($item['enabled'])==1) { ?>checked='checked'<?php  } ?>> 是否显示
		      </label>
		    </div>
		  </div>
		</div>
	  
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">提交</button>
			</div>
		</div>
	  
	</form>

<?php  } else if($op == 'display') { ?>

<form action="" method="post" onsubmit="">
<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>选择</th>
					<th>名称</th>
					<th>父级菜单</th>
					<th>是否开启</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  echo $o;?>
			</tbody>
		</table>
		<table class="table">
			<tr>
				<td class="span1">
					<input type="submit" name="delete" value="删除" class="btn btn-primary" />		
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />		
				</td>
			</tr>
		</table>
		<?php  echo $pager;?>
	</div>
</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>