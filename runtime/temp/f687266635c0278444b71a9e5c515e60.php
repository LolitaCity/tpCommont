<?php /*a:2:{s:74:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/node/index.html";i:1540609010;s:81:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/public//pagerForm.html";i:1540609010;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url(); ?>"> 
    <input type="hidden" name="pageNum" value="<?php echo htmlentities((app('request')->post('pageNum') ?: '')); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo htmlentities((app('request')->post('numPerPage') ?: '')); ?>" /> 
    <input type="hidden" name="_order" value="<?php echo htmlentities((isset($order) && ($order !== '')?$order:'')); ?>" />
    <input type="hidden" name="_sort" value="<?php echo htmlentities((isset($sort) && ($sort !== '')?$sort:'')); ?>" />  
</form>



<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo url(); ?>" method="post">
	<div class="searchBar">		
            <table class="searchContent">
                <tr>
                    <td>
                        节点名：<input type="text" name="name" value="<?php echo htmlentities(app('request')->post('name')); ?>"/>
                    </td>
                    <td>
                        <select class="combox" name="p_id">
                            <option value="">父节点</option>
                            <?php foreach($topNoList as $vo): ?>
                                <option value="<?php echo htmlentities($vo['id']); ?>" <?php if((input('p_id')==$vo['id'])): ?> selected = "selected" <?php endif; ?> ><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; ?>                            
                        </select>
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
            <li><a class="add" href="<?php echo url('/admin/node/show'); ?>" target="dialog" mask="true"><span>添加</span></a></li>                      
            <li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="id[]" href="<?php echo url('/admin/node/del'); ?>" class="delete"><span>批量删除</span></a></li>                  
            <li><a class="edit" href="/admin/node/show/id/{l_id}" target="dialog" mask="true" warn="请选择一条信息"><span>修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="80%" layoutH="138">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="id[]" class="checkboxCtrl"></th>
                <th width="40"  align="center">序号</th>
                <th width="120" >节点名称</th>
                <th width="100" >控制器</th>
                <th width="80" >方法</th>
                <th width="100" orderField="level" align="center" <?php if((input('_order')=='level')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?>>层级</th>
                <th width="80"  orderField="ord"  align="center" <?php if((input('_order')=='ord')): ?> class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?>>排序</th>
                <th width="80"  orderField="p_id"   align="center" <?php if((input('_order')=='p_id')): ?>  class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?>>父节点</th>
                <th width="130" orderField="add_time"   align="center" <?php if((input('_order')=='add_time')): ?>  class="<?php echo htmlentities(app('request')->post('_sort')); ?>" <?php endif; ?>>添加时间</th>
                <th width="100" align="center">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $key=>$vo): ?>
                <tr target="l_id" rel="<?php echo htmlentities($vo['id']); ?>">
                <td><input name="id[]" value="<?php echo htmlentities($vo['id']); ?>" type="checkbox"></td>
                <td><?php echo htmlentities($key+1); ?></td>
                <td>
                    <?php if(($vo['level']==0)): ?>
                        <div style='color:blue'> <?php echo htmlentities($vo['name']); ?> </div>
                    <?php else: ?>
                        <div style='color:green'>-- <?php echo htmlentities($vo['name']); ?> </div>
                    <?php endif; ?>                    
                </td>
                <td><?php echo htmlentities($vo['controller']); ?></td>
                <td><?php echo htmlentities($vo['action']); ?></td>
                <td>
                    <?php if($vo['level'] == '0'): ?>
                        <div style='color:blue'> 顶级节点 </div>
                    <?php else: ?>
                        <div style='color:green'> 次级节点 </div>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlentities($vo['ord']); ?></td>
                <td <?php if(($vo['p_id'] == 0)): ?> style="color:blue" <?php else: ?> style='color:green' <?php endif; ?> ><?php echo htmlentities(getNodeName($vo['p_id'])); ?></td>
                <td><?php echo htmlentities(date("Y-m-d H:i:s ",!is_numeric($vo['add_time'])? strtotime($vo['add_time']) : $vo['add_time'])); ?></td>           
                <td>                    
                    <a title="确定删除该记录" target="ajaxTodo" href="<?php echo url('Node/del',array('id'=>code($vo['id'],1))); ?>" style='color: red'>删除</a>                       
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>        
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20" <?php if((input('numPerPage')==20)): ?> selected = "selected"  <?php endif; ?>>20</option>
                <option value="50" <?php if((input('numPerPage')==50)): ?> selected = "selected"  <?php endif; ?>>50</option>
                <option value="100" <?php if((input('numPerPage')==100)): ?> selected = "selected"  <?php endif; ?>>100</option>
                <option value="200" <?php if((input('numPerPage')==200)): ?> selected = "selected"  <?php endif; ?>>200</option>
            </select>
            <span>条，共<?php echo htmlentities($totalCount); ?>条</span>          
        </div>
        <!--
        totalCount      控制整个页码列表
        numPerPage      控制页码数量，避免页码无休止
        pageNumShown    页码列表数量，显示几个页码1 2 3
        currentPage     指定当前页的style状态（当前页红色）
        -->
        <div class="pagination" targetType="navTab" totalCount="<?php echo htmlentities($totalCount); ?>" numPerPage="<?php echo htmlentities($numPerPage); ?>" pageNumShown="5"  currentPage="<?php echo htmlentities($currentPage); ?>"></div>
    </div>
</div>