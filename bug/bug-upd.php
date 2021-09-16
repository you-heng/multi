<?php
include("head.php");
include 'api/config.php';
include 'api/datebase.php';
$sql = "SELECT * FROM b_user WHERE is_role=2 OR is_role=3";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM b_project";
$result = $link->query($sql);
$project = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" id="id" name="id">
            <div class="layui-form-item" style="width: 57%">
                <label class="layui-form-label">
                    <span class="x-red">*</span>报告标题
                </label>
                <div class="layui-input-block">
                    <input type="text" id="bug_title" name="bug_title" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>权限
                    </label>
                    <div class="layui-input-inline">
                        <select name="is_role" lay-verify="required" lay-search>
                            <?php foreach($config['role'] as $k => $v){ ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>问题类型
                    </label>
                    <div class="layui-input-inline">
                        <select name="is_type" lay-verify="required" lay-search>
                            <?php foreach($config['type'] as $k => $v){ ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>优先级
                    </label>
                    <div class="layui-input-inline">
                        <select name="is_priority" lay-verify="required" lay-search>
                            <?php foreach($config['priority'] as $k => $v){ ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>程度
                    </label>
                    <div class="layui-input-inline">
                        <select name="is_weight" lay-verify="required" lay-search>
                            <?php foreach($config['weight'] as $k => $v){ ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>分派给
                    </label>
                    <div class="layui-input-inline">
                        <select name="solve_id" lay-verify="required" lay-search>
                            <?php foreach($user as $k => $v){ ?>
                                <option value="<?php echo $v['id'] ?>"><?php echo $v['username'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>项目
                    </label>
                    <div class="layui-input-inline">
                        <select name="project_id" lay-verify="required" lay-search>
                            <?php foreach($project as $k => $v){ ?>
                                <option value="<?php echo $v['id'] ?>"><?php echo $v['project_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>bug所在系统
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" name="system" id="system" required  lay-verify="required" placeholder="请输入输入框内容" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>系统版本
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" name="system_ver" id="system_ver" required  lay-verify="required" placeholder="请输入输入框内容" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>上传图片
                </label>
                <div class="layui-input-inline">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="test1">上传图片</button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" style="width: 200px;" id="demo1">
                            <p id="demoText"></p>
                        </div>
                        <input type="hidden" name="bug_img" id="bug_img">
                    </div>
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>
            <div class="layui-form-item" style="width: 57%">
                <label class="layui-form-label">
                    <span class="x-red">*</span>bug详情内容
                </label>
                <div class="layui-input-block">
                    <textarea name="bug_desc" id="bug_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
                <div class="layui-form-mid layui-word-aux">
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
            layer = layui.layer,
            upload = layui.upload;



        //常规使用 - 普通图片上传
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: './api/uploading.php' //改成您自己的上传接口
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });

                element.progress('demo', '0%'); //进度条复位
                layer.msg('上传中', {icon: 16, time: 0});
            }
            ,done: function(res){
                console.log(res);
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }else{
                    $("#bug_img").val(res.data.src);
                }
                //上传成功的一些操作
                //……
                $('#demoText').html(''); //置空上传失败的状态
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
            //进度条
            ,progress: function(n, index, e){
                element.progress('demo', n + '%'); //可配合 layui 进度条元素使用
                if(n == 100){
                    layer.msg('上传完毕', {icon: 1});
                }
            }
        });


        //监听提交
        form.on('submit(upd)', function(data) {
            data.field.type = 2;
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
