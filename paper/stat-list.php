<?php
include("head.php");
session_start();
$username = $_SESSION['username'];
$is_role = $_SESSION['is_role'];
include 'api/datebase.php';
if($is_role == 1 || $is_role == 0){
    $sql = "SELECT * FROM p_admin WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT * FROM p_document WHERE b_id='{$user[0]['b_id']}'";
    $result = $link->query($sql);
    $doc = mysqli_fetch_all($result,MYSQLI_ASSOC);
}else if($is_role == 2){
    $sql = "SELECT * FROM p_teacher WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT * FROM p_document WHERE t_id='{$user[0]['id']}'";
    $result = $link->query($sql);
    $doc = mysqli_fetch_all($result,MYSQLI_ASSOC);
}else if($is_role == 3){
    $sql = "SELECT * FROM p_student WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT * FROM p_document WHERE t_id='{$user[0]['t_id']}'";
    $result = $link->query($sql);
    $doc = mysqli_fetch_all($result,MYSQLI_ASSOC);
}
?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">我的信息</a>
            <a>
              <cite>下载文档</cite></a>
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
                            <input type="hidden" id="b_id" name="b_id" value="<?php echo $user[0]['b_id'] ?>">
                            <button type="button" class="layui-btn" style="display: none" id="test1"></button>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>毕业任务书
                                </label>
                                <?php if($is_role == 2){ ?>
                                <div class="layui-input-inline">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn" id="paper_report">上传毕业任务书</button>
                                        <input type="hidden" name="paper_report" id="paper_report_url">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="layui-input-inline">
                                    <button onclick="location.href='<?php echo $doc[0]['paper_report'] ?>'" value="<?php echo $doc[0]['paper_report'] ?>" type="button" class="layui-btn" id="test1"><i class="layui-icon"></i><?php if(!empty($doc[0]['paper_report'])){ echo '下载毕业任务书'; }else{ echo '暂无内容'; } ?></button>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>毕业论文指导说明书
                                </label>
                                <?php if($is_role == 2){ ?>
                                <div class="layui-input-inline">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn" id="guide_report">上传毕业论文指导说明书</button>
                                        <input type="hidden" name="guide_report" id="guide_report_url">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="layui-input-inline">
                                    <button type="button" onclick="location.href='<?php echo $doc[0]['guide_report'] ?>'" value="<?php echo $doc[0]['guide_report'] ?>" class="layui-btn" id="test1"><i class="layui-icon"></i><?php if(!empty($doc[0]['guide_report'])){ echo '下载毕业论文指导说明书'; }else{ echo '暂无内容'; } ?></button>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>答辩申请表
                                </label>
                                <?php if($is_role == 2){ ?>
                                <div class="layui-input-inline">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn" id="reply_report">上传答辩申请表</button>
                                        <input type="hidden" name="reply_report" id="reply_report_url">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="layui-input-inline">
                                    <button type="button" onclick="location.href='<?php echo $doc[0]['reply_report'] ?>'" value="<?php echo $doc[0]['reply_report'] ?>" class="layui-btn" id="test1"><i class="layui-icon"></i><?php if(!empty($doc[0]['reply_report'])){ echo '下载答辩申请表'; }else{ echo '暂无内容'; } ?></button>
                                </div>
                            </div>
                            <?php if($is_role == 2){ ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                </label>
                                <button  class="layui-btn" lay-filter="add" onclick="return false;" lay-submit="">
                                    提交
                                </button>
                            </div>
                            <?php } ?>
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
            layer = layui.layer,
            upload = layui.upload;

        var doc = '';
        //常规使用 - 普通图片上传
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: './api/upload.php' //改成您自己的上传接口
            ,accept:'file'
            ,before: function(obj){
                element.progress('demo', '0%'); //进度条复位
                layer.msg('上传中', {icon: 16, time: 0});
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }else{
                    $("#"+ doc).val(res.data.src);
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

        $("#paper_report").click(()=>{
            doc = 'paper_report_url';
            $("#test1").click();
        });

        $("#guide_report").click(()=>{
            doc = 'guide_report_url';
            $("#test1").click();
        });

        $("#reply_report").click(()=>{
            doc = 'reply_report_url';
            $("#test1").click();
        });

        //监听提交
        form.on('submit(add)', function(data) {
            $.post('./api/doc.php',{data:data.field},(res)=>{
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