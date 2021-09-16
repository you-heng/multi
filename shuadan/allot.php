<?php include './api/page-auth.php';  ?>
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
    <style>
         .layui-form-switch{margin-top: 0}
    </style>
</head>

<body>

    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-block">
                            <input type="text" name="phone" placeholder="请输入" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline" id="shop">
                        <label class="layui-form-label">店铺名</label>
                        <div class="layui-input-inline">
                            <select name="shop_id" lay-filter="Type_filter" id="shop_id">
                                <option value="">请选择店铺名</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="0" id="elect" name="elect">
                    <div class="layui-inline">
                        <label class="layui-form-label">是否随机</label>
                        <div class="layui-input-inline">
                            <input type="checkbox" name="switch" id="switch" lay-skin="switch" lay-text="随机|自选" lay-filter="switch">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="gen-order">
                            点击生成
                        </button>
                    </div>
                </div>
            </div>

            <div class="layui-card-body">
                <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
            </div>
        </div>
    </div>

    <script src="lib/layui/layui.js"></script>
    <script>
        layui.config({
            base: 'lib/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table'], function() {
            var $ = layui.$,
                form = layui.form,
                admin = layui.admin,
                table = layui.table;

            $("#shop").show();
            form.on('switch(switch)', function(obj){
                if(obj.elem.checked == false){
                    $("#shop").show();
                    $("#elect").val(0);
                }else{
                    $("#shop").hide();
                    $("#elect").val(1);
                }
            });
            admin.req({
                url: 'api/shop-form.php',
                type: 'post',
                data: {type:6},
                success: function (res) {
                    $.each(res.data, function (index, item) {
                        $('#shop_id').append(new Option(item.shop_name, item.id));// 下拉菜单里添加元素
                    });
                    form.render("select");
                }
            });


            //用户管理
            table.render({
                elem: '#LAY-user-manage',
                url: 'api/gen-order.php',
                cols: [
                    [{
                            type: 'checkbox',
                            fixed: 'left'
                        }, {
                            field: 'id',
                            width: 100,
                            title: '链接ID',
                            sort: true
                        }, {
                            field: 'link',
                            title: '刷单链接'
                        }, {
                            field: 'shop_id',
                            title: '店铺ID'
                        }, {
                            field: 'shop_name',
                            title: '店铺名称'
                        }
                        // ,{title: '操作',width:150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
                    ]
                ],
                page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                    layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,
                    limit: 10,
                    groups: 1 //只显示 1 个连续页码
                        ,
                    first: false //不显示首页
                        ,
                    last: false //不显示尾页

                },
                toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
                    ,
                defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                    title: '提示',
                    layEvent: 'LAYTABLE_TIPS',
                    icon: 'layui-icon-tips'
                }],
                title: '刷单链接表',
                height: 'full-220',
                text: '对不起，加载出现异常！'
            });

            //监听工具条
            table.on('tool(LAY-user-manage)', function(obj) {
                var data = obj.data;
                if (obj.event === 'del') {} else if (obj.event === 'edit') {}
            });

            //生成订单
            form.on('submit(gen-order)', function(data) {
                var field = data.field;
                //执行重载
                table.reload('LAY-user-manage', {
                    url: 'api/gen-order.php',
                    method: 'get',
                    where: field,
                    page: {
                        curr: 1 //从第一页开始
                    },
                    limit: 10
                });
            });
        });
    </script>
</body>

</html>