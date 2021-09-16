<?php
include("head.php");
session_start();
$is_role = $_SESSION['is_role'];
$username = $_SESSION['username'];
include 'api/datebase.php';
$sql = "SELECT id FROM b_user WHERE username='{$username}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">缺陷管理</a>
            <a>
              <cite>缺陷报告</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-card-header">
                    <button class="layui-btn" onclick="xadmin.open('添加缺陷报告','./bug-add.php','100%','100%')"><i
                            class="layui-icon"></i>添加
                    </button>
                    <button class="layui-btn" onclick="location='./api/export.php'"><i
                                class="layui-icon">&#xe67d;</i>一键导出缺陷报告
                    </button>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-hide" id="test" lay-filter="test"></table>

                    <script type="text/html" id="bug_img">
                        <img src="{{d.bug_img}}" style="width: 100px;height: 100px" alt="">
                    </script>
                    <script type="text/html" id="barDemo">
                        {{# if(<?php echo $is_role ?> == 2 && d.solve_id == <?php echo $user[0]['id'] ?> && (d.is_state == 2 || d.is_state == 5)){ }}
                        <a class="layui-btn layui-btn-fluid layui-btn-warm" lay-event="state">修改报告状态</a>
                        {{# }else if(<?php echo $is_role ?> != 2){ }}
                        <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="state">状态</a>
                        {{# } }}
                        {{# if(<?php echo $is_role ?> != 2){ }}
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                        {{# } }}
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['table', 'layer','jquery'], function () {
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer;

        table.render({
            elem: '#test'
            , url: './api/bug-list.php'
            , toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
            , defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                title: '提示'
                , layEvent: 'LAYTABLE_TIPS'
                , icon: 'layui-icon-tips'
            }]
            , title: '用户数据表'
            , cols: [[
                {type: 'checkbox', fixed: 'left'}
                , {field: 'id', title: 'ID', width: 80, fixed: 'left', sort: true}
                , {field: 'bug_title', title: '报告标题', width: 150}
                , {field: 'put_name', title: '提交人', width: 150}
                , {field: 'project_name', title: '项目名', width: 150}
                , {field: 'solve_name', title: '解决人', width: 150}
                , {field: 'state', title: '状态', width: 150}
                , {field: 'role', title: '权限', width: 150}
                , {field: 'priority', title: '优先级', width: 150}
                , {field: 'type', title: '问题类型', width: 150}
                , {field: 'bug_img', title: '图片', toolbar: '#bug_img', width: 150}
                , {field: 'system', title: '问题所在系统', width: 150}
                , {field: 'system_ver', title: '系统版本', width: 150}
                , {field: 'bug_desc', title: '报告详情', width: 350}
                , {field: 'weight', title: '严重程度', width: 250}
                , {field: 'create_time', title: '创建时间', sort: true, width: 150}
                , {field: 'update_time', title: '修改时间', sort: true, width: 150}
                , {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 200}
            ]]
            , page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                //,curr: 5 //设定初始在第 5 页
                , groups: 1 //只显示 1 个连续页码
                , first: false //不显示首页
                , last: false //不显示尾页
            }
        });

        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.post('./api/bug.php',{data:{id:data.id,type:3}},(res)=>{
                        let data = JSON.parse(res);
                        layer.msg(data.msg);
                        if(data.code == 0){
                            obj.del();
                            layer.close(index);
                        }
                    })
                });
            } else if (obj.event === 'edit') {
                layer.open({
                    type: 2
                    , title: '编辑'
                    , content: 'bug-upd.php'
                    , maxmin: true
                    , area: ['100%', '100%']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-order-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段

                        });
                        submit.trigger('click');
                    }
                    , success: function (layero, index) {
                        //编辑数据的回显
                        var body = layer.getChildFrame('body', index);
                        body.contents().find("#id").val(data.id);
                        body.contents().find("#bug_title").val(data.bug_title);
                        body.contents().find("#system").val(data.system);
                        body.contents().find("#system_ver").val(data.system_ver);
                        body.contents().find("#bug_img").val(data.bug_img);
                        body.contents().find("#bug_desc").val(data.bug_desc);
                        body.contents().find("#demo1").attr('src',data.bug_img);
                        body.contents().find("select[name='is_role']").val(data.is_role);
                        body.contents().find("select[name='is_type']").val(data.is_type);
                        body.contents().find("select[name='is_priority']").val(data.is_priority);
                        body.contents().find("select[name='is_weight']").val(data.is_weight);
                        body.contents().find("select[name='solve_id']").val(data.solve_id);
                        body.contents().find("select[name='project_id']").val(data.project_id);
                    }
                });
            }else if(obj.event === 'state'){
                layer.open({
                    type: 2
                    , title: '状态'
                    , content: 'bug-state.php'
                    , maxmin: true
                    , area: ['600px', '400px']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-order-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段

                        });
                        submit.trigger('click');
                    }
                    , success: function (layero, index) {
                        //编辑数据的回显
                        var body = layer.getChildFrame('body', index);
                        body.contents().find("#id").val(data.id);
                        body.contents().find("#bug_title").val(data.bug_title);
                        body.contents().find("select[name='is_state']").val(data.is_state);
                    }
                });
            }
        });
    });
</script>
</html>