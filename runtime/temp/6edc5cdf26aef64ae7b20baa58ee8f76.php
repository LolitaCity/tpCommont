<?php /*a:1:{s:84:"E:\phpStudy\PHPTutorial\WWW\TpCommon\application\admin\view\public\login_dialog.html";i:1540209707;}*/ ?>
<div class="pageContent">
    <form method="post" action="<?php echo url('Auth/checkLogin'); ?>" class="pageForm" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <input type="hidden" name='notCaptcha' value="1"/>
        <div class="pageFormContent" layoutH="58">
            <div class="unit">
                <label>用户名：</label>
                <input type="text" name="username" size="20" class="required"/>
            </div>
            <div class="unit">
                <label>密码：</label>
                <input type="password" name="password" size="20" class="required" id="password"/>
            </div>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
<script src="/static/jQuery.md5.js" type="text/javascript"></script>
<script>
    $(function(){
        $("input[name='password']").blur(function(){
            var passwd=$("#password").val();
            $("#password").val($.md5(passwd));
        });
   });
</script>