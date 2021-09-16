<?php
include("head.php");
session_start();
$username = $_SESSION['username'];
include "api/datebase.php";
$sql = "SELECT t2.* FROM p_student AS t1
LEFT JOIN p_task AS t2 ON t1.t_id=t2.t_id
WHERE t1.username='{$username}'";
$result = $link->query($sql);
$task = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" id="username" name="username" value="<?php echo $username ?>">
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>选择一个课题
                </label>
                <div class="layui-input-inline">
                    <select name="ts_id" lay-verify="required" lay-search>
                        <?php foreach($task as $k => $v){ ?>
                            <option value="<?php echo $v['id'] ?>"><?php echo $v['task_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="upd" onclick="return false;" lay-submit="">
                    确定
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer'], function() {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(upd)', function(data) {
            data.field.type = 4;
            $.post('./api/task.php',{data:data.field},(res)=>{
                let data = JSON.parse(res);
                layer.msg(data.msg);
                if(data.code == 0){
                    setTimeout(()=>{
                        //关闭当前frame
                        xadmin.close();
                        // 可以对父窗口进行刷新
                        xadmin.father_reload();
                    },1000);
                }
            });
        });
    });
</script>
</body>

</html>
