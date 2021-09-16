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
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 40px 0 0">
    <input type="hidden" name="id" id="id">
    <div class="layui-form-item">
        <label class="layui-form-label">店铺名</label>
        <div class="layui-input-block">
            <select name="shop_id" lay-filter="Type_filter" id="shop_id" lay-verify="required">
                <option value="">请选择店铺名</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">链接</label>
        <div class="layui-input-block">
            <input type="text" name="link" id="link" lay-verify="required" placeholder="请输入链接" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
    </div>
</div>

<script src="lib/layui/layui.js"></script>
<script>
    layui.config({
        base: 'lib/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'upload'], function(){
        var $ = layui.$
            ,form = layui.form
            ,admin = layui.admin;

        admin.req({
            url: 'api/link-form.php',
            type: 'post',
            data: {type:4},
            success: function (res) {
                $.each(res.data, function (index, item) {
                    $('#shop_id').append(new Option(item.shop_name, item.id));// 下拉菜单里添加元素
                });
                form.render("select");
            }
        });
    })
</script>
</body>
</html>