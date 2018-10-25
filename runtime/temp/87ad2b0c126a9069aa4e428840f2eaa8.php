<?php /*a:2:{s:75:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\system\log.html";i:1540209707;s:82:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\public\\pagerForm.html";i:1540209707;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url(); ?>"> 
    <input type="hidden" name="pageNum" value="<?php echo htmlentities((app('request')->post('pageNum') ?: '')); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo htmlentities((app('request')->post('numPerPage') ?: '')); ?>" /> 
    <input type="hidden" name="_order" value="<?php echo htmlentities((isset($order) && ($order !== '')?$order:'')); ?>" />
    <input type="hidden" name="_sort" value="<?php echo htmlentities((isset($sort) && ($sort !== '')?$sort:'')); ?>" />  
</form>



<div class="pageHeader">
    <?php if(isset($type)&&$type==1): ?>
        <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo url('system/optionLog'); ?>" method="post">
    <?php else: ?>
        <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo url('system/loginLog'); ?>" method="post">
    <?php endif; ?>
	<div class="searchBar">		
            <table class="searchContent">
                <tr>
                    <?php if(isset($type)&&$type==1): ?>
                        <td>
                            内容关键字：<input type="text" name="content" value="<?php echo htmlentities(app('request')->post('content')); ?>"/>
                        </td> 
                    <?php endif; ?>
                    <td>
                        操作人：<input type="text" name="userId"  value="<?php echo htmlentities(app('request')->post('userId')); ?>"/>
                    </td>
                    <td>
                        添加时间：<input type="text" name="add_time" class="date" readonly="true" value="<?php echo htmlentities(app('request')->post('add_time')); ?>"/>
                    </td>
                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
                </ul>
            </div>
	</div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">  
            <li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="id[]" href="<?php echo url('system/delete',array('db'=>code('Log',1))); ?>" class="delete"><span>批量删除</span></a></li>                  
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="70%" layoutH="138">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="id[]" class="checkboxCtrl"></th>
                <th width="50"  align="center">序号</th>
                <?php if(isset($type)&&$type==1): ?>
                    <th width="60" orderField='user_id' <?php if((input('_order')=='user_id')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?>  align="center">操作人</th>
                    <th width="60" align="center">数据库</th>
                    <th width="240" >内容</th>
                    <th width="120"  orderField='add_time' <?php if((input('_order')=='add_time')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?> align="center">添加时间</th>
                <?php else: ?>
                    <th width="60" orderField='user_id' <<?php if((input('_order')=='user_id')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?> align="center">登录人</th>
                    <th width="80" align="center">ip</th>
                    <th width="100" align="center">地点</th>
                    <th width="120"  orderField='add_time' <?php if((input('_order')=='add_time')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?> align="center">登录时间</th>
                <?php endif; ?>
                <th width="70" align="center">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $k=>$vo): ?>
                <tr target="l_id" rel="<?php echo htmlentities($vo['id']); ?>">
                    <td><input name="id[]" value="<?php echo htmlentities($vo['id']); ?>" type="checkbox"></td>
                    <td><?php echo htmlentities($k+1); ?></td>
                    <td style="color:blue"><?php echo htmlentities(getAdminName($vo['user_id'])); ?></td>
                    <?php if(isset($type)&&$type==1): ?>
                        <td style="color:green"><?php echo htmlentities($vo['db']); ?></td>
                        <td><?php echo htmlentities($vo['content']); ?></td>
                    <?php else: ?>
                        <td style="color:green"><?php echo htmlentities($vo['ip']); ?></td>
                        <td><?php echo htmlentities($vo['addr']); ?></td>
                    <?php endif; ?>
                    <td><?php echo htmlentities(date("Y-m-d H:i:s",!is_numeric($vo['add_time'])? strtotime($vo['add_time']) : $vo['add_time'])); ?></td>
                    <td>
                        <a title="确定删除该记录" target="ajaxTodo" href="<?php echo url('System/delete',array('id'=>code($vo['id'],1),'db'=>code('Log',1))); ?>" style='color:red'>删除</a>                       
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>        
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
            <span>条，共<?php echo htmlentities($totalCount); ?>条</span>          
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo htmlentities($totalCount); ?>" numPerPage="<?php echo htmlentities($numPerPage); ?>" pageNumShown="6"  currentPage="<?php echo htmlentities($currentPage); ?>"></div>
    </div>
</div>
