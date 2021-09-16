<?php
include("head.php");
session_start();
$is_role = $_SESSION['is_role'];
?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">系统设置</a>
            <a>
              <cite>通知管理</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <?php if($is_role == 1 || $is_role == 0){ ?>
                <div class="layui-card-header">
                    <button class="layui-btn" onclick="xadmin.open('发布通知','./notice-add.php','800px','600px')"><i
                            class="layui-icon"></i>发布通知
                    </button>
                </div>
                <?php } ?>
                <div class="layui-card-body ">
                    <table class="layui-hide" id="test" lay-filter="test"></table>

                    <script type="text/html" id="title">
                        <a lay-event="detail">{{d.title}}</a>
                    </script>

                    <script type="text/html" id="barDemo">
                        <?php if($is_role == 1 || $is_role == 0){ ?>
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                        <?php } ?>
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
            , url: './api/notice-list.php'
            , title: '管理员数据表'
            , cols: [[
                {type: 'checkbox', fixed: 'left'}
                , {field: 'id', title: 'ID', width: 80, fixed: 'left', sort: true}
                , {field: 'title', title: '通知标题', toolbar: '#title'}
                , {field: 'create_time', title: '创建时间'}
                , {field: 'update_time', title: '修改时间'}
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
                    $.post('./api/notice.php',{data:{id:data.id,type:3}},(res)=>{
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
                    , content: 'notice-upd.php'
                    , maxmin: true
                    , area: ['800px', '600px']
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
                        body.contents().find("#title").val(data.title);
                        body.contents().find("#notice_desc").val(data.notice_desc);
                        body.contents().find("select[name='is_auth']").val(data.is_auth);
                        body.contents().find("input[name='is_type'][value=" + data.is_type + "]").prop('checked','true');
                    }
                });
            } else if(obj.event === 'detail'){
                layer.open({
                    type: 2
                    , title: '编辑'
                    , content: 'notice-detail.php'
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
                        body.contents().find("#title").text(data.title);
                        body.contents().find("#notice_desc").text(data.notice_desc);
                    }
                });
            }
        });
    });
</script>
</html>