<?php
include("head.php");
session_start();
$username = $_SESSION['username'];
include 'api/datebase.php';
$sql = "SELECT * FROM b_user WHERE username='{$username}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">我的信息</a>
            <a>
              <cite>我的</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-fluid" style="padding-top: 50px">
                    <div class="layui-row">
                        <form class="layui-form">
                            <input type="hidden" id="id" name="id" value="<?php echo $user[0]['id'] ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>用户名
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="username" name="username" value="<?php echo $username ?>" autocomplete="off" lay-verify="required" required class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>密码
                                </label>
                                <div class="layui-input-inline">
                                    <input type="password" id="password" name="password" required autocomplete="off" lay-verify="required" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                </label>
                                <button  class="layui-btn" lay-filter="add" onclick="return false;" lay-submit="">
                                    修改
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['form', 'layer'], function() {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data) {
            data.field.type = 4;
            $.post('./api/admin.php',{data:data.field},(res)=>{
                let data = JSON.parse(res);
                layer.msg(data.msg);
                if(data.code == 0){
                    setTimeout(()=>{
                        // 可以对父窗口进行刷新
                        xadmin.father_reload();
                    },1000);
                }
            });
        });
    });
</script>
</html>