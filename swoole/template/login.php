<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>客服工作台</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="http://mi.anmixiu.com/cdn/layui/css/layui.css">
    <link rel="stylesheet" href="../lib/css/index.css">
    <script src="http://mi.anmixiu.com/cdn/layui/layui.js" charset="utf-8"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">客服工作台</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form">
        <input name="username" placeholder="用户名" type="text" lay-verify="required" class="layui-input">
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
</div>

<script>
    layui.use('form', function () {
        var form = layui.form;
        //监听提交
        form.on('submit(login)', function (data) {
            fetch("../server/login.php", {
                method: 'post',
                body: JSON.stringify(data.field),
                headers: {'Content-Type': 'application/json'}
            }).then(response => response.json()).then(data => {
                layer.msg(data.msg)
                if(data.code === 0){
                    location.href = 'server.php'
                }
            })
            return false;
        });
    });
</script>
</body>
</html>