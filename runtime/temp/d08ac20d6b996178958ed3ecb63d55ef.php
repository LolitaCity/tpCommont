<?php /*a:2:{s:76:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\index\index.html";i:1540347623;s:75:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\index\main.html";i:1540209707;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通用后台系统</title>

<link href="/static/admin/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/static/admin/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/static/admin/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="/static/admin/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lt IE 9]><script src="js/speedup.js" type="text/javascript"></script><script src="js/jquery-1.11.3.min.js" type="text/javascript"></script><![endif]-->
<!--[if gte IE 9]><!-->
<script src="/static/admin/dwz/js/jquery-2.1.4.min.js" type="text/javascript"></script><!--<![endif]-->

<script src="/static/admin/dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/static/admin/dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="/static/admin/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="/static/admin/dwz/xheditor/xheditor-1.2.2.min.js" type="text/javascript"></script>
<script src="/static/admin/dwz/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="/static/admin/dwz/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="/static/admin/dwz/chart/raphael.js"></script>
<script type="text/javascript" src="/static/admin/dwz/chart/g.raphael.js"></script>
<script type="text/javascript" src="/static/admin/dwz/chart/g.bar.js"></script>
<script type="text/javascript" src="/static/admin/dwz/chart/g.line.js"></script>
<script type="text/javascript" src="/static/admin/dwz/chart/g.pie.js"></script>
<script type="text/javascript" src="/static/admin/dwz/chart/g.dot.js"></script>


<!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换时下面dwz.regional.zh.js还需要引入)-->
<script src="/static/admin/dwz/js/dwz.min.js" type="text/javascript"></script>

<script src="/static/admin/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){

	DWZ.init("/static/admin/dwz/dwz.frag.xml", {
		loginUrl:"/admin/Auth/loginDialog", loginTitle:"Login",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
		keys: {statusCode:"statusCode", message:"message"}, //【可选】
		ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
		debug:false,	// 调试模式 【true|false】
		callback:function(){
                    initEnv();
                    $("#themeList").theme({themeBase:"/static/admin/dwz/themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});
</script>
<style>
    #info tr{height: 35px;}
</style>
</head>
<body>
    <div id="layout">
        <div id="header">
            <div class="headerNav">
                <a class="logo" href="__CONTROLLER__">标志</a>
                <ul class="nav">
                    <eq name="Think.session.authId" value="1">
                        <li><a href="<?php echo url('auth/systemInfo'); ?>" target="dialog" height="420" width="490">系统消息</a></li>                       
                        <li><a href="<?php echo url('bak/backup'); ?>">数据库备份</a></li>
                    </eq>
                    <li><a href="<?php echo url('system/delCache'); ?>" target="ajaxTodo">清除缓存</a></li>
                    <li><a href="<?php echo url('system/changePwd'); ?>" target="dialog" width="600">修改密码</a></li>
                    <li><a href="<?php echo url('auth/loginOut'); ?>" onclick="if (confirm('确定退出系统?')) return true; else return false;">退出</a></li>
                </ul>
                <ul class="themeList" id="themeList">
                    <li theme="default"><div class="selected">蓝色</div></li>
                    <li theme="green"><div>绿色</div></li>
                    <li theme="purple"><div>紫色</div></li>
                    <li theme="silver"><div>银色</div></li>
                    <li theme="azure"><div>天蓝</div></li>
                </ul>
            </div>
            <!-- navMenu -->			
        </div>
        <div id="leftside">
            <div id="sidebar_s">
                <div class="collapse">
                    <div class="toggleCollapse"><div></div></div>
                </div>
            </div>
            <div id="sidebar">
                <div class="toggleCollapse"><h2>主菜单</h2><div>Shrink</div></div>
                    <div class="accordion" fillSpace="sidebar">                      
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <?php foreach($oneNodeList as $one): ?>
                <li><a <?php if(!(empty($one['action']) || (($one['action'] instanceof \think\Collection || $one['action'] instanceof \think\Paginator ) && $one['action']->isEmpty()))): ?> href="<?php echo url($one['controller'].'/'.$one['action']); ?>" rel="<?php echo htmlentities($one['controller']); ?>"  target="navTab" <?php endif; ?> ><?php echo htmlentities($one['name']); ?></a>
                    <ul>                        
                        <?php foreach($twoNodeList as $two): if(($two['p_id'] == $one['id'])): ?>
                                <li>
                                    <a href="<?php echo url($two['controller'].'/'.$two['action']); ?>" rel="<?php echo htmlentities($two['controller']); ?>" target="navTab"><?php echo htmlentities($two['name']); ?></a>
                                </li>
                                <?php endif; endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>                    
</div>
            </div>
        </div>
        <div id="container">
            <div id="navTab" class="tabsPage">
                <div class="tabsPageHeader">
                    <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                        <ul class="navTab-tab">
                            <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">主页</span></span></a></li>
                        </ul>
                    </div>
                    <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                    <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                    <div class="tabsMore">more</div>
                </div>
                    <ul class="tabsMoreList">
                        <li><a href="javascript:;">主页</a></li>
                    </ul>
                <div class="navTab-panel tabsPageContent layoutBox">
                    <div class="page unitBox">                        
                        <div class="pageFormContent" layoutH="80" style="margin-right:230px">
                            <table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
                                <tr height=100>
                                    <td align=middle width=100><img height=100 src="/static/admin/img/admin_p.gif" width=90 /></td>
                                    <td width=60>&nbsp;</td>
                                    <td>
                                        <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>
                                            <tr>
                                                <td>时间:<?php echo date('Y-m-d h:i:s',time()); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; font-size: 16px"><?php echo htmlentities(app('session')->get('user.name')); ?></td>
                                            </tr>
                                            <tr>
                                                <td>欢迎进入管理中心!</td>
                                            </tr>
                                        </table>                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3 height=10></td>
                                </tr>
                            </table>                         
                            
                            <div class="buttonActive" target="_blank"><span>基本信息（oschina）</span></div>
                            <div class="divider"></div>
                            
                            <table cellspacing=0 cellpadding=2 width="95%" align=center border=0 id="info" style="font-size:20px">
                                <tr>
                                    <td align=right width=100>用户:</td>
                                    <td style="color: #880000"><?php echo htmlentities(app('session')->get('user.name')); ?></td>
                                </tr>
                                <tr>
                                    <td align=right width=100>角色:</td>
                                    <td style="color: #880000"><?php echo htmlentities(getAdminRole(app('session')->get('authId'))); ?></td>
                                </tr>
                                <tr>
                                    <td align=right>注册时间:</td>
                                    
                                    <td style="color: #880000"><?php echo htmlentities(date("Y-m-d H:i",!is_numeric(app('session')->get('user.add_time'))? strtotime(app('session')->get('user.add_time')) : app('session')->get('user.add_time'))); ?></td>
                                </tr>
                                <tr>
                                    <td align=right>登陆次数:</td>
                                    <td style="color: #880000"><?php echo htmlentities(app('session')->get('user.inc')); ?></td>
                                </tr>
                                <tr>
                                    <td align=right>上次登录时间:</td>
                                    <td style="color: #880000"><?php echo htmlentities(date("Y-m-d H:i",!is_numeric(app('session')->get('user.last_logintime'))? strtotime(app('session')->get('user.last_logintime')) : app('session')->get('user.last_logintime'))); ?></td>
                                </tr>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">Copyright &copy; 2010 <a href="demo_page2.html" target="dialog">DWZ团队</a> 京ICP备15053290号-2</div>
</body>    
</html>
