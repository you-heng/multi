<?php include 'api/config.php';  unset($config['role'][0]) ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>论文管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="<?php echo $config['path']; ?>style/css/font.css">
    <link rel="stylesheet" href="<?php echo $config['path']; ?>style/css/login.css">
    <link rel="stylesheet" href="<?php echo $config['path']; ?>style/css/xadmin.css">
    <script src="<?php echo $config['path']; ?>style/lib/layui/layui.js" charset="utf-8"></script>
    <script src="<?php echo $config['path']; ?>style/js/jquery.min.js" charset="utf-8"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">论文管理系统登录</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" >
        <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <select name="is_role" lay-verify="required" lay-search>
            <option value=""></option>
            <?php foreach($config['role'] as $k => $v){ ?>
            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
        <hr class="hr15">
        <div style="display: flex;flex-direction: row">
            <input style="width: 50%" name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input">
            <img id="refresh" style="margin-left:10%;width: 40%;border: 0" src="<?php echo $config['path']; ?>api/verifyCode.php" alt="">
        </div>
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" onclick="return false;" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    $(function  () {
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(login)', function(data){
                $.post('./api/login.php',{data:data.field},(res)=>{
                    let data = JSON.parse(res);
                    if(data.code == 0){
                        window.location.href = data.url + '/index.php'+ data.state;
                    }else{
                        alert(data.msg);
                    }
                });
            });
        });
    });

    $("#refresh").click(()=>{
        $("#refresh").attr('src',"<?php echo $config['path']; ?>api/verifyCode.php?" + new Date().getTime());
    });
</script>
</body>
</html>