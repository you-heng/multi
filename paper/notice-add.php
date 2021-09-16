<?php
include("head.php");
include "api/config.php";
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>通知标题
                </label>
                <div class="layui-input-block">
                    <input type="text" id="title" name="title" lay-verify="required" required autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>通知内容
                </label>
                <div class="layui-input-block">
                    <textarea name="notice_desc" id="notice_desc" lay-verify="required" required placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>发布范围
                </label>
                <div class="layui-input-block">
                    <select name="is_auth" lay-verify="required" lay-search>
                        <?php foreach($config['notice'] as $k => $v){ ?>
                            <option value="<?php echo $k ?>"><?php echo $v ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>通知类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_type" value="1" title="答辩类" checked>
                    <input type="radio" name="is_type" value="2" title="论文类">
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
            $.post('./api/notice.php',{data:data.field},(res)=>{
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
