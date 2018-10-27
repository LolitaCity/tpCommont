<?php /*a:2:{s:72:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/web/info.html";i:1540609010;s:81:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/public//pagerForm.html";i:1540609010;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url(); ?>"> 
    <input type="hidden" name="pageNum" value="<?php echo htmlentities((app('request')->post('pageNum') ?: '')); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo htmlentities((app('request')->post('numPerPage') ?: '')); ?>" /> 
    <input type="hidden" name="_order" value="<?php echo htmlentities((isset($order) && ($order !== '')?$order:'')); ?>" />
    <input type="hidden" name="_sort" value="<?php echo htmlentities((isset($sort) && ($sort !== '')?$sort:'')); ?>" />  
</form>



<div class="pageHeader">
   
</div>
<script src="/static/js/main.js" type="text/javascript"></script>

<style>
    #webInfo{
        border: 1px solid #DAE0F1;margin-left: 10px;border-collapse: collapse;
    }
    #webInfo tr{
        height:55px;
    }
    #webInfo td{
        border: 1px solid #DAE0F1;
    }
    #editWeb{
        margin-right:93%;
    }
</style>
<table width="98%" layoutH="45" id="webInfo" nowrapTD="false" class="list">
    <tbody>
        <tr>
            <td style="width:150px;">网站名称</td>
            <td><?php echo htmlentities((isset($webInfo['name']) && ($webInfo['name'] !== '')?$webInfo['name']:'')); ?></td>
        </tr>
        <tr>
            <td style="width:150px;">英文网站名称</td>
            <td><?php echo htmlentities((isset($webInfo['en_name']) && ($webInfo['en_name'] !== '')?$webInfo['en_name']:'')); ?></td>
        </tr>
        <tr>
            <td>网站图标</td>
            <td class="imgs"><img src="/static/upload/<?php echo htmlentities((isset($webInfo['icon']) && ($webInfo['icon'] !== '')?$webInfo['icon']:'')); ?>" width="96px"/></td>
        </tr>
        <tr>
            <td>LOGO</td>
            <td class="imgs"><img src="/static/upload/<?php echo htmlentities((isset($webInfo['logo']) && ($webInfo['logo'] !== '')?$webInfo['logo']:'')); ?>" width="96px"/></td>
        </tr>
        <tr>
            <td>公众号</td>
            <td class="imgs"><img src="/static/upload/<?php echo htmlentities((isset($webInfo['small_image']) && ($webInfo['small_image'] !== '')?$webInfo['small_image']:'')); ?>" width="96px"/></td>
        </tr>
        <tr>
            <td>关于我们图片</td>
            <td class="imgs"><img src="/static/upload/<?php echo htmlentities((isset($webInfo['small_img']) && ($webInfo['small_img'] !== '')?$webInfo['small_img']:'')); ?>" width="96px"/></td>
        </tr>
        <tr>
            <td>SEO关键字</td>
            <td><?php echo htmlentities((isset($webInfo['keywords']) && ($webInfo['keywords'] !== '')?$webInfo['keywords']:'')); ?></td>
        </tr>
        <tr>
            <td>SEO英文关键字</td>
            <td><?php echo htmlentities((isset($webInfo['en_keywords']) && ($webInfo['en_keywords'] !== '')?$webInfo['en_keywords']:'')); ?></td>
        </tr>
        <tr>
            <td>网站描述</td>
            <td><?php echo htmlentities((isset($webInfo['desc_']) && ($webInfo['desc_'] !== '')?$webInfo['desc_']:'')); ?></td>
        </tr>
        <tr>
            <td>网站英文描述</td>
            <td><?php echo htmlentities((isset($webInfo['en_desc_']) && ($webInfo['en_desc_'] !== '')?$webInfo['en_desc_']:'')); ?></td>
        </tr>
        <tr>
            <td>联系电话1</td>
            <td><?php echo htmlentities((isset($webInfo['tel']) && ($webInfo['tel'] !== '')?$webInfo['tel']:'')); ?></td>
        </tr>
        <tr>
            <td>联系电话2</td>
            <td><?php echo htmlentities((isset($webInfo['tel_1']) && ($webInfo['tel_1'] !== '')?$webInfo['tel_1']:'')); ?></td>
        </tr>
        <tr>
            <td>联系电话3</td>
            <td><?php echo htmlentities((isset($webInfo['tel_2']) && ($webInfo['tel_2'] !== '')?$webInfo['tel_2']:'')); ?></td>
        </tr>
        <tr>
            <td>网址1</td>
            <td><?php echo htmlentities((isset($webInfo['weburl']) && ($webInfo['weburl'] !== '')?$webInfo['weburl']:'')); ?></td>
        </tr>
        <tr>
            <td>网址2</td>
            <td><?php echo htmlentities((isset($webInfo['weburl_2']) && ($webInfo['weburl_2'] !== '')?$webInfo['weburl_2']:'')); ?></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><?php echo htmlentities((isset($webInfo['email']) && ($webInfo['email'] !== '')?$webInfo['email']:'')); ?></td>
        </tr>
        <tr>
            <td>地址</td>
            <td><?php echo htmlentities((isset($webInfo['address']) && ($webInfo['address'] !== '')?$webInfo['address']:'')); ?></td>
        </tr>
        <tr>
            <td>英文地址</td>
            <td><?php echo htmlentities((isset($webInfo['en_address']) && ($webInfo['en_address'] !== '')?$webInfo['en_address']:'')); ?></td>
        </tr>
        <tr>
            <td>版权信息</td>
            <td><?php echo htmlentities((isset($webInfo['copyright']) && ($webInfo['copyright'] !== '')?$webInfo['copyright']:'')); ?></td>
        </tr>
        <tr>
            <td>英文版权信息</td>
            <td><?php echo htmlentities((isset($webInfo['en_copyright']) && ($webInfo['en_copyright'] !== '')?$webInfo['en_copyright']:'')); ?></td>
        </tr>
    </tbody>        
</table>
<div class="formBar">
    <ul id="editWeb">
        <li><div class="buttonActive"><div class="buttonContent"><a href="<?php echo url('Web/show',array('id'=>code($webInfo['id']?$webInfo['id']:'1',1),'sign'=>code('1',1))); ?>" target="dialog" mask="true" width='800' height='600'><button>编辑</button></a ></div></div></li>       
    </ul>
</div>
<style type="text/css" media="screen">
    .imgs div{height:100px!important;}
</style>