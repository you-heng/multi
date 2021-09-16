<?php
include("head.php");
include 'api/config.php';
session_start();
$is_role = $_SESSION['is_role'];
$state = $config['state'];
if($is_role == 2 || $is_role == 3){
    unset($state[2]);
    unset($state[3]);
}
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="bug_title" name="bug_title">
            <div class="layui-form-item" style="width: 57%">
                <label class="layui-form-label">
                    <span class="x-red">*</span>报告状态
                </label>
                <div class="layui-input-block">
                    <select name="is_state" lay-verify="required" lay-search>
                        <?php foreach($state as $k => $v){ ?>
                            <option value="<?php echo $k ?>"><?php echo $v ?></option>
                        <?php } ?>
                    </select>
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
<script>
    layui.use(['form', 'layer'], function() {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data) {
            data.field.type = 4;
            $.post('./api/bug.php',{data:data.field},(res)=>{
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
