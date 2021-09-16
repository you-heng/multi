<?php include 'api/page-auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台刷单管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="lib/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="lib/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <script type="text/html" template>
            <h1>您好！-- {{ JSON.parse(localStorage.getItem(layui.setter.tableName)).name }} --欢迎使用刷单后台管理系统</h1>
        </script>
    </div>
</div>

<script src="lib/layui/layui.js?t=1"></script>
<script>
    layui.config({
        base: 'lib/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console']);
</script>
</body>
</html>

