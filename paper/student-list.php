<?php include("head.php"); ?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">用户管理</a>
            <a>
              <cite>学生</cite></a>
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
                    <button class="layui-btn" onclick="xadmin.open('添加学生','./student-add.php','500px','600px')"><i
                            class="layui-icon"></i>添加学生
                    </button>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-hide" id="test" lay-filter="test"></table>

                    <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
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
            , url: './api/student-list.php'
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
                , {field: 'username', title: '用户名'}
                , {field: 'role', title: '角色'}
                , {field: 'ip', title: '登录ip'}
                , {field: 'name', title: '所属学院'}
                , {field: 'teacher_name', title: '导师'}
                , {field: 'task_name', title: '课题'}
                , {field: 'group_name', title: '组'}
                , {field: 'serialNumber', title: '学号'}
                , {field: 'email', title: '邮箱'}
                , {field: 'phone', title: '手机号码'}
                , {field: 'login_time', title: '登录时间', sort: true}
                , {field: 'create_time', title: '创建时间', sort: true}
                , {field: 'update_time', title: '修改时间', sort: true}
                , {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 150}
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
                    $.post('./api/student.php',{data:{id:data.id,type:3}},(res)=>{
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
                    , content: 'student-upd.php'
                    , maxmin: true
                    , area: ['500px', '600px']
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
                        body.contents().find("#username").val(data.username);
                        body.contents().find("#serialNumber").val(data.serialNumber);
                        body.contents().find("select[name='b_id']").val(data.b_id);
                        body.contents().find("select[name='t_id']").val(data.t_id);
                    }
                });
            }
        });
    });
</script>
</html>