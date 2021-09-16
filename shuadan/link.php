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
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">店铺名</label>
                    <div class="layui-input-block">
                        <input type="text" name="shop_name" placeholder="请输入" autocomplete="off" class="layui-input">
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

            <script type="text/html" id="toolbarDemo">
                <div class="layui-btn-container">
                    <button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
                </div>
            </script>
            <script type="text/html" id="table-useradmin-webuser">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
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
    }).use(['index', 'table','admin'], function(){
        var $ = layui.$
            ,form = layui.form
            ,admin = layui.admin
            ,table = layui.table;

        //用户管理
        table.render({
            elem: '#LAY-user-manage'
            ,url: 'api/link.php'
            ,cols: [[
                {type: 'checkbox', fixed: 'left'}
                ,{field: 'id', width: 100, title: 'ID', sort: true}
                ,{field: 'shop_name', title: '店铺名'}
                ,{field: 'link', title: '链接'}
                ,{field: 'num', title: '刷单总数'}
                ,{title: '操作',width:150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
            ]]
            ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                //,curr: 5 //设定初始在第 5 页
                ,limit:10
                , limits: [10 , 20 , 50 , 100 , 1000 , 2000]
                ,groups: 1 //只显示 1 个连续页码
                ,first: false //不显示首页
                ,last: false //不显示尾页

            }
            ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示'
                ,layEvent: 'LAYTABLE_TIPS'
                ,icon: 'layui-icon-tips'
            }]
            ,title: '链接数据表'
            ,height: 'full-220'
            ,text: '对不起，加载出现异常！'
        });

        //头工具栏事件
        table.on('toolbar(LAY-user-manage)', function(obj){
            switch(obj.event){
                case 'add':
                    layer.open({
                        type: 2
                        ,title: '添加链接'
                        ,content: 'link-form.php'
                        ,maxmin: true
                        ,area: ['500px', '450px']
                        ,btn: ['确定', '取消']
                        ,yes: function(index, layero){
                            var iframeWindow = window['layui-layer-iframe'+ index]
                                ,submitID = 'LAY-user-front-submit'
                                ,submit = layero.find('iframe').contents().find('#'+ submitID);

                            //监听提交
                            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                                var field = data.field; //获取提交的字段
                                //提交 Ajax 成功后，静态更新表格中的数据
                                admin.req({
                                    url: 'api/link-form.php',
                                    type: 'post',
                                    data: {data:field,type:1},
                                    success: function (res) {
                                        layer.msg(res.msg);
                                        if (res.code === 0) {
                                            layer.msg(res.msg);
                                            layui.table.reload('LAY-user-manage'); //重载表格
                                        }
                                    }
                                });
                                table.reload('LAY-user-front-submit'); //数据刷新
                                layer.close(index); //关闭弹层
                            });
                            submit.trigger('click');
                        }
                    });
                    break;
            };
        });

        //监听工具条
        table.on('tool(LAY-user-manage)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    data.type = 3;
                    admin.req({
                        url: 'api/link-form.php',
                        type: 'post',
                        data: data,
                        success: function (res) {
                            layer.msg(res.msg);
                            if (res.code === 0) {
                                obj.del();
                                layer.close(index);
                            }
                        }
                    });
                });
            } else if(obj.event === 'edit'){
                var tr = $(obj.tr);
                layer.open({
                    type: 2
                    ,title: '编辑用户'
                    ,content: 'link-form.php'
                    ,maxmin: true
                    ,area: ['500px', '450px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var iframeWindow = window['layui-layer-iframe'+ index]
                            ,submitID = 'LAY-user-front-submit'
                            ,submit = layero.find('iframe').contents().find('#'+ submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            admin.req({
                                url: 'api/link-form.php',
                                type: 'post',
                                data: {data:field,type:2},
                                success: function (res) {
                                    layer.msg(res.msg);
                                    if (res.code === 0) {
                                        layui.table.reload('LAY-user-manage'); //重载表格
                                    }
                                }
                            });
                            table.reload('LAY-user-manage'); //数据刷新
                            layer.close(index); //关闭弹层
                        });

                        submit.trigger('click');
                    }
                    ,success: function(layero, index){
                        //编辑数据的回显
                        var body = layer.getChildFrame('body', index);
                        body.contents().find("#id").val(data.id);
                        body.contents().find("#link").val(data.link);
                    }
                });
            }
        });


        //监听搜索
        form.on('submit(LAY-user-front-search)', function(data){
            var field = data.field;

            //执行重载
            table.reload('LAY-user-manage', {
                url: 'api/link-form.php'
                , method: 'post'
                , where: {data:field,type:5}
                , page: {
                    curr:1 //从第一页开始
                }
                , limit: 10
            });
        });

        $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
</body>
</html>
