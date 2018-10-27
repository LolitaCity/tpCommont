<?php /*a:2:{s:80:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/user/admin_index.html";i:1540609010;s:81:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/public//pagerForm.html";i:1540609010;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url(); ?>"> 
    <input type="hidden" name="pageNum" value="<?php echo htmlentities((app('request')->post('pageNum') ?: '')); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo htmlentities((app('request')->post('numPerPage') ?: '')); ?>" /> 
    <input type="hidden" name="_order" value="<?php echo htmlentities((isset($order) && ($order !== '')?$order:'')); ?>" />
    <input type="hidden" name="_sort" value="<?php echo htmlentities((isset($sort) && ($sort !== '')?$sort:'')); ?>" />  
</form>



<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo url('user/adminIndex'); ?>" method="post">
	<div class="searchBar">		
            <table class="searchContent">
                <tr>
                    <td>
                        用户名：<input type="text" name="name"  value="<?php echo htmlentities(app('request')->post('name')); ?>"/>
                    </td>
                    <td>
                        昵称：<input type="text" name="nick_name" value="<?php echo htmlentities(app('request')->post('nick_name')); ?>"/>
                    </td>
                    <td>
                        电话：<input type="text" name="tel" value="<?php echo htmlentities(app('request')->post('tel')); ?>"/>
                    </td>
                    <td>
                        邮箱：<input type="text" name="email" value="<?php echo htmlentities(app('request')->post('email')); ?>"/>
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
            <li><a class="add" href="<?php echo url('User/show',array('sign'=>code('2',1),'db'=>code('Admin',1))); ?>" target="dialog" mask="true" width='600' height='400'><span>添加用户</span></a></li>                      
            <li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="id[]" href="<?php echo url('User/del',array('db'=>code('Admin',1))); ?>" class="delete"><span>批量删除</span></a></li>                  
            <li><a class="edit" href="/admin/user/show/id/{l_id}/sign/<?php echo code('2',1);?>/db/<?php echo code('Admin',1)?>" target="dialog" mask="true" warn="请选择一条信息" width='600' height='400'><span>修改用户</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="88%" layoutH="138">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="id[]" class="checkboxCtrl"></th>
                <th width="40"  align="center">序号</th>
                <?php if(app('session')->get('authId') == '1'): ?>
                    <th width="40" align="center" orderField='id' <?php if((input('_order')=='id')): ?> class="<?php echo htmlentities(app('request')->post('_order')); ?>" <?php endif; ?> >id</th>
                    <th width="150" align="center" orderField='last_logintime' <?php if((input('_order')=='last_logintime')): ?> class="<?php echo htmlentities(app('request')->post('_order')); ?>" <?php endif; ?> >上次登录时间</th>
                <?php endif; ?>
                <th width="100" align="center">用户名</th>
                <th width="100" align="center">昵称</th>
                <th width="100" align="center">电话</th>
                <th width="120" align="center">邮箱</th>
                <th width="100" align="center">角色</th>
                <th width="140" align="center" orderField='add_time' <?php if((input('_order')=='add_time')): ?> class="<?php echo htmlentities(app('request')->post('_order')); ?>" <?php endif; ?> >注册日期</th>
                <th width="150" align="center">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $k=>$vo): ?>
                <tr target="l_id" rel="<?php echo htmlentities($vo['id']); ?>">
                    <td><input name="id[]" value="<?php echo htmlentities($vo['id']); ?>" type="checkbox"></td>
                    <td><?php echo htmlentities($k+1); ?></td>
                    <?php if(app('session')->get('authId') == '1'): ?>
                        <td><?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?></td>
                        <td><?php echo htmlentities(date("Y-m-d H:i:s",!is_numeric($vo['last_logintime'])? strtotime($vo['last_logintime']) : $vo['last_logintime'])); ?></td>
                    <?php endif; ?>
                    <td style='color:blue'><?php echo htmlentities($vo['name']); ?></td>
                    <td style='color:royalblue'><?php echo htmlentities((isset($vo['nick_name']) && ($vo['nick_name'] !== '')?$vo['nick_name']:'')); ?></td>
                    <td><?php echo htmlentities($vo['tel']); ?></td>
                    <td><?php echo htmlentities($vo['email']); ?></td>
                    <td style='color:green'><?php echo htmlentities(getAdminRole($vo['id'])); ?></td>
                    <td><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($vo['add_time'])? strtotime($vo['add_time']) : $vo['add_time'])); ?></td>
                    <td>
                        <a title="确定删除该用户" target="ajaxTodo" href="<?php echo url('User/del',array('id'=>code($vo['id'],1),'db'=>code('Admin',1))); ?>" style='color:red'>删除</a>                       
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
</div><style type="text/css" media="screen">
    .imgs div{height:100px!important;}
</style>
