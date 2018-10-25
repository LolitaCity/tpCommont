<?php /*a:2:{s:73:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\web\role.html";i:1540209707;s:82:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\public\\pagerForm.html";i:1540209707;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url(); ?>"> 
    <input type="hidden" name="pageNum" value="<?php echo htmlentities((app('request')->post('pageNum') ?: '')); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo htmlentities((app('request')->post('numPerPage') ?: '')); ?>" /> 
    <input type="hidden" name="_order" value="<?php echo htmlentities((isset($order) && ($order !== '')?$order:'')); ?>" />
    <input type="hidden" name="_sort" value="<?php echo htmlentities((isset($sort) && ($sort !== '')?$sort:'')); ?>" />  
</form>



<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo url('Web/role'); ?>" method="post">
	<div class="searchBar">		
            <table class="searchContent">
                <tr>
                    <td>
                        角色名称：<input type="text" name="name" value="<?php echo htmlentities((app('request')->post('name') ?: '')); ?>"/>
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
            <li><a class="add" href="<?php echo url('Web/show',array('sign'=>code('2',1),'db'=>code('Role',1))); ?>" target="dialog" mask="true" width='400' height='200'><span>添加角色</span></a></li>                      
            <li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="id[]" href="<?php echo url('Web/del',array('db'=>code('Role',1),'sign'=>code('1',1))); ?>" class="delete"><span>批量删除</span></a></li>                  
            <li><a class="edit" href="/admin/web/show/id/{l_id}/sign/<?= code('2',1);?>/db/<?= code('Role',1);?>" target="dialog" mask="true" warn="请选择一条信息" width='400' height='200'><span>角色修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="350" layoutH="138">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="id[]" class="checkboxCtrl"></th>
                <th width="60"  align="center">序号</th>
                <th width="118" >角色名称</th>               
                <th width="150" align="center">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $k=>$vo): if($vo['name'] != '普通用户'): ?>
                    <tr target="l_id" rel="<?php echo htmlentities($vo['id']); ?>">
                        <td><input name="id[]" value="<?php echo htmlentities($vo['id']); ?>" type="checkbox"></td>
                        <td><?php echo htmlentities($k+1); ?></td>
                        <td><?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:'')); ?></td>          
                        <td>
                            <a href="<?php echo url('Web/nodeList',array('role_id'=>code($vo['id'],1))); ?>" target="dialog" height="600" width="500"><span style='color:green'>角色授权</span></a> | 
                            <a title="确定删除该角色" target="ajaxTodo" href="<?php echo url('Web/del',array('id'=>code($vo['id'],1),'db'=>code('Role',1),'sign'=>code('1',1))); ?>" style='color:red'>删除</a>                       
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
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
