<?php
include("head.php");
include "api/datebase.php";
$sql = "SELECT * FROM p_college";
$result = $link->query($sql);
$college = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" id="id" name="id">
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>教师名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="username" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="password" name="password" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>工号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="serialNumber" name="serialNumber" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>院系
                </label>
                <div class="layui-input-inline">
                    <select name="b_id" lay-verify="required" lay-search>
                        <?php foreach($college as $k => $v){ ?>
                            <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="upd" onclick="return false;" lay-submit="">
                    更新
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
            data.field.type = 2;
            $.post('./api/teacher.php',{data:data.field},(res)=>{
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
