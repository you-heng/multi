<?php include("head.php"); ?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>项目名称
                </label>
                <div class="layui-input-block">
                    <input type="text" id="project_name" name="project_name" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">项目介绍</label>
                <div class="layui-input-block">
                    <textarea name="project_desc" id="project_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" onclick="return false;" lay-submit="">
                    增加
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
            data.field.type = 1;
            $.post('./api/project.php',{data:data.field},(res)=>{
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
