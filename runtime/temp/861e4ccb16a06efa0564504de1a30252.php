<?php /*a:1:{s:74:"/Applications/MAMP/htdocs/tpCommont/application/admin/view/auth/index.html";i:1537097887;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aeotec background management platform</title>
<link href="/static/admin/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
<script src="/static/jquery.js" type="text/javascript"></script>
<script src="/static/jQuery.md5.js" type="text/javascript"></script>
</head>
    <style>
        #subt{
            border: 0;
            background: #ffffff;
            width:0px;
            height:0px;
        }
    </style>
<body>
    <div id="login">
        <div id="login_header">
            <h1 class="login_logo">              
            </h1>
            <div class="login_headerContent">
             
                <h2 class="login_title">
            </div>
        </div>
        <div id="login_content">
            <div class="loginForm">
                <form action="<?php echo url('Auth/checkLogin'); ?>" method="post" id="myForm">
                    <p>
                        <label>用户名：</label>
                        <input type="text" name="username" size="20" class="login_input" />
                    </p>
                    <p>
                        <label>密　码：</label>
                        <input type="password" name="password" size="20" class="login_input" />
                    </p>                    
                    <?php if(app('config')->get('CAPTCHA_ON') == '1'): ?>
                        <p>
                            <label>验证码：</label>
                            <input class="code" id="captcha" name="captcha" type="text" size="5"/>
                            <span><img src="<?php echo url('auth/verify'); ?>" id="verify_img"  alt="" onclick="this.src='<?php echo url('auth/verify'); ?>?seed='+Math.random()" /></span>
                            
                            <input type="hidden" name='captcha_exists' value="1" id='captcha_exitst'>
                        </p>
                    <?php endif; ?>
                </form>
                <div class="login_bar">
                    <a class="sub" id="sub"></a>                       
                </div>                
            </div>
            <div class="login_banner"><img src="/static/admin/dwz/themes/default/images/login_banner_.jpg" /></div>
            <div class="login_main">
            </div>
        </div>
        <div id="login_footer">
        </div>
    </div>
</body>
</html>
<script>
    $(function(){
        $(document).keyup(function(event){
            if(event.keyCode ==13){
               $("#sub").click();
            }
        });
        $("#sub").click(function(){
            var username=$("input[name='username']").val();
            var password=$("input[name='password']").val();
            var captcha =$("#captcha").val();
            var captcha_exists=$("#captcha_exitst").val();
            if(username==''){
                alert('请填写用户名');
                return false;
            }
            if(password==''){
                alert('请填写密码');
                return false;
            }
            if(captcha_exists==1 && captcha==''){
                alert('请填写验证码');
                return false;
            }
            var flag=null;            
            $.ajax({
                async: false,
                url:'/admin/auth/checkLogin',
                data:{captcha:captcha,username:username,password:$.md5(password)},
                success:function(msg){
                    if(msg!=1000){
                        alert(msg);
                        return false;
                    }
                    flag=1;
                }
            });
            if(flag==1){                
                $(location).attr('href', '/admin/index');
            }
        });            
    });
        
</script>
