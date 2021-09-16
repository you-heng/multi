<?php include("head.php"); ?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">系统设置</a>
            <a>
              <cite>通知详情</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-fluid" id="LAY-app-message-detail">
                    <div class="layui-card layuiAdmin-msg-detail">
                        <div class="layui-card-header">
                            <h1 id="title"></h1>
                            <p>
                                <span id="notice_desc"></span>
                            </p>
                        </div>
                        <div class="layui-card-body layui-text">
                            <div class="layadmin-text">

                            </div>

                            <div style="padding-top: 30px;">
<!--                                <a href="javascript:;" layadmin-event="back" class="layui-btn layui-btn-primary layui-btn-sm">返回上级</a>-->
                            </div>
                        </div>
                    </div>
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
    });
</script>
</html>