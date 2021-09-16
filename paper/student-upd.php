<?php
include("head.php");
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" id="id" name="id">
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>学生名
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
                    <span class="x-red">*</span>学号
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
                    <select name="b_id" lay-verify="required" lay-filter="college" id="college" lay-search>
                        <option value="">选择一个院系</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>导师
                </label>
                <div class="layui-input-inline">
                    <select name="t_id" lay-verify="required" lay-filter="teacher" id="teacher" lay-search>
                        <option value="">选择一个导师</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>组
                </label>
                <div class="layui-input-inline">
                    <select name="g_id" lay-verify="required" lay-filter="group" id="group" lay-search>
                        <option value="">选择一个组</option>
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
    layui.use(['form', 'layer','jquery'], function() {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.jquery;

        //监听提交
        form.on('submit(upd)', function(data) {
            data.field.type = 2;
            $.post('./api/student.php',{data:data.field},(res)=>{
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


        $(function () {
            $.post('./api/student.php',{data:{type:4}},(res)=>{
                let data = JSON.parse(res);
                if(data.code == 0){
                    var list = data.data;
                    var s = '<option value="">选择一个院系</option>';
                    $.each(list, function (i, company) {
                        s = s + '<option value="' + company.id + '">' + company.name + '</option>';
                    });
                    $("#college").html(s);
                    form.render('select');
                }
            });
        });

        form.on('select(college)', function (data) {
            var id = data.value;
            if (id == '') {
                $("#teacher").html();
                form.render('select');

                $("#group").html();
                form.render('select');
            } else {
                $.post('./api/student.php',{data:{type:5,id:id}},(res)=>{
                    let data = JSON.parse(res);
                    if(data.code == 0){
                        var list = data.data;
                        var s = '';
                        $.each(list, function (i, ss) {
                            s = s + '<option value="' + ss.id + '">' + ss.username + '</option>';
                        });
                        $("#teacher").html(s);
                        form.render('select');
                    }
                });

                $.post('./api/student.php',{data:{type:6,id:id}},(res)=>{
                    let data = JSON.parse(res);
                    if(data.code == 0){
                        var list = data.data;
                        var s = '';
                        $.each(list, function (i, ss) {
                            s = s + '<option value="' + ss.id + '">' + ss.group_name + '</option>';
                        });
                        $("#group").html(s);
                        form.render('select');
                    }
                });
            }
        });


    });
</script>
</body>
</html>
