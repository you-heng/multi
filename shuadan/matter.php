<?php include './api/page-auth.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>后台刷单管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="lib/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="lib/style/admin.css" media="all">
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
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>

            <script type="text/html" id="is_pay">
                {{# if(d.is_pay == 1){ }}
                <a class="layui-btn layui-btn-disabled layui-btn-xs">已打款</a>
                {{# }else if(d.is_pay == 2){ }}
                <a class="layui-btn layui-btn-danger layui-btn-xs">未打款</a>
                {{# }else if(d.is_pay == 3){ }}
                <a class="layui-btn layui-btn-normal layui-btn-xs">已分配</a>
                {{# } }}
            </script>

            <script type="text/html" id="is_star">
                {{# if(d.is_star == 1){ }}
                <a class="layui-btn layui-btn-disabled layui-btn-xs">已五星好评</a>
                {{# }else if(d.is_star == 2){ }}
                <a class="layui-btn layui-btn-danger layui-btn-xs">未五星好评</a>
                {{# } }}
            </script>

            <script type="text/html" id="table-useradmin-webuser">
                {{# if(d.is_star == 1){ }}
                <a class="layui-btn layui-btn layui-btn-xs" lay-event="check">反悔</a>
                {{# }else if(d.is_star == 2){ }}
                <a class="layui-btn layui-btn layui-btn-xs" lay-event="check">审核</a>
                {{# } }}

                {{# if(d.is_pay == 1){ }}
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="pay">反悔</a>
                {{# }else if(d.is_pay == 2){ }}
                <a class="layui-btn layui-btn layui-btn-xs" lay-event="pay">打款</a>
                {{# } }}
                <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="remark">备注</a>
            </script>
        </div>
    </div>
</div>

<script src="lib/layui/layui.js"></script>
<script>
    layui.config({
        base: 'lib/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table', 'admin'], function () {
        var $ = layui.$,
            admin = layui.admin,
            form = layui.form,
            table = layui.table;

        //用户管理
        table.render({
            elem: '#LAY-user-manage',
            url: 'api/matter.php',
            cols: [
                [{
                    type: 'checkbox',
                    fixed: 'left'
                }, {
                    field: 'id',
                    width: 100,
                    title: 'ID',
                    sort: true
                }, {
                    field: 'user_phone',
                    title: '用户手机'
                }, {
                    field: 'link_id',
                    title: '链接ID'
                }, {
                    field: 'is_star',
                    title: '是否五星 1:是 2:否',
                    templet: '#is_star'
                }, {
                    field: 'number',
                    title: '订单编号'
                }, {
                    field: 'remark',
                    title: '备注'
                }, {
                    field: 'is_pay',
                    title: '是否打款 1:是 2:否',
                    templet: '#is_pay'
                }, {
                    field: 'shop_id',
                    title: '店铺ID'
                }, {
                    field: 'create_time',
                    title: '刷单时间',
                    sort: true
                }, {
                    field: 'pay_time',
                    title: '打款时间',
                    sort: true
                }, {
                    title: '操作',
                    width: 200,
                    align: 'center',
                    fixed: 'right',
                    toolbar: '#table-useradmin-webuser'
                }]
            ],
            page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'], //自定义分页布局
                //,curr: 5 //设定初始在第 5 页
                limit: 10,
                limits: [10, 20, 50, 100, 1000, 2000],
                groups: 1, //只显示 1 个连续页码
                first: false, //不显示首页
                last: false //不显示尾页
            },
            toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
            defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            title: '刷单信息表',
            height: 'full-220',
            text: '对不起，加载出现异常！'
        });

        //监听工具条
        table.on('tool(LAY-user-manage)', function (obj) {
            var data = obj.data;
            // 打款
            if (obj.event === 'pay') {
                layer.confirm('确认已打款', {
                    icon: 1,
                    title: '打款'
                }, function (index) {
                    data.type = 2
                    admin.req({
                        url: 'api/matter-form.php',
                        type: 'post',
                        data: data,
                        success: function (res) {
                            layer.msg(res.msg);
                            if (res.code === 0) {
                                table.reload('LAY-user-manage');
                                layer.close(index);
                            }
                        }
                    });

                });

                // 好评审核
            } else if (obj.event === 'check') {
                layer.confirm('确认已五星好评', {
                    icon: 1,
                    title: '审核'
                }, function (index) {
                    data.type = 1;
                    admin.req({
                        url: 'api/matter-form.php',
                        type: 'post',
                        data: data,
                        success: function (res) {
                            layer.msg(res.msg);
                            if (res.code === 0) {
                                table.reload('LAY-user-manage');
                                layer.close(index);
                            }
                        }
                    });

                });
                // 订单备注
            } else if (obj.event === 'remark') {
                layer.prompt({
                    formType: 2,
                    value: '',
                    title: '请输入备注',
                    area: ['400px', '100px']
                }, function (value, index, elem) {

                    admin.req({
                        url: 'api/matter-form.php',
                        type: 'post',
                        data: {
                            remark: value,
                            id: data.id,
                            type: 3
                        },
                        success: function (res) {
                            layer.msg(res.msg);
                            if (res.code === 0) {
                                table.reload('LAY-user-manage');
                                layer.close(index);
                            }
                        }
                    });
                });
            }
        });


        //监听搜索
        form.on('submit(LAY-user-front-search)', function (data) {
            var field = data.field;
            field.type = 4;
            //执行重载
            table.reload('LAY-user-manage', {
                url: 'api/matter-form.php',
                method: 'post',
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