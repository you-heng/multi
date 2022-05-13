<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lib/css/layui.css">
    <title>五大手机厂商APP推送</title>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">APP厂商推送</div>
                <div class="layui-card-body">
                    <form class="layui-form" action="" onsubmit="return false">
                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg8">
                                <label class="layui-form-label">消息标题：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title" lay-verify="required" placeholder="请输入消息标题"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-col-lg8">
                            <label class="layui-form-label">消息内容：</label>
                            <div class="layui-input-block">
                                <textarea name="content" placeholder="请输入消息内容" class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">点击动作：</label>
                            <div class="layui-input-block">
                                <input type="radio" name="click" lay-filter="click" value="1" title="打开APP首页" checked>
                                <input type="radio" name="click" lay-filter="click" value="2" title="打开APP指定页面">
                                <input type="radio" name="click" lay-filter="click" value="3" title="打开指定网页">
                            </div>
                        </div>
                        <div class="layui-row layui-col-space10 layui-form-item" id="url">
                            <div class="layui-col-lg8">
                                <label class="layui-form-label">跳转地址：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="url" placeholder="请输入跳转地址" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">推送范围：</label>
                            <div class="layui-input-block">
                                <input type="radio" name="scope" lay-filter="scope" value="1" title="单推(用户id)" checked>
                                <input type="radio" name="scope" lay-filter="scope" value="2" title="全推">
                            </div>
                        </div>
                        <div class="layui-row layui-col-space10 layui-form-item" id="phone">
                            <div class="layui-col-lg8">
                                <label class="layui-form-label">用户id：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="userid" placeholder="请输入手机号码"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item" id="manufacturer">
                            <label class="layui-form-label">厂商：</label>
                            <div class="layui-input-block">
                                <input type="checkbox" name="manufacturer[oppo]" title="oppo">
                                <input type="checkbox" name="manufacturer[vivo]" title="vivo">
                                <input type="checkbox" name="manufacturer[huawei]" title="华为">
                                <input type="checkbox" name="manufacturer[meizu]" title="魅族">
                                <input type="checkbox" name="manufacturer[xiaomi]" title="小米">
                            </div>
                            <div class="layui-inline">
                                <div class="layui-form-mid layui-word-aux">可以选择单个厂商全推或者多个厂商全推，不选默认是所有厂商都全推</div>
                                <br>
                                <div class="layui-form-mid layui-word-aux">注：vivo的全量推送一天只有一次。</div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="component-form-element">立即提交</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
<script src="lib/layui.js"></script>
<script src="https://www.anmixiu.com/cdn/jquery/jquery-3.5.1.min.js"></script>
<script>

    //form
    layui.use('form', function () {
        var form = layui.form;

        //监听提交
        form.on('submit(component-form-element)', function (data) {
            var field = data.field;
            fetch("push/index.php", {
                method: 'post',
                body: JSON.stringify(field),
                headers: {'Content-Type': 'application/json'}
            }).then(response => response.json()).then(data => {
                layer.msg(data.msg)
            })
        });


        //默认选中打开首页，所以默认隐藏
        $("#url").hide();
        //判断是否是打开指定网页
        form.on('radio(click)', function(data){
            if(data.value == 1){
                $("#url").hide();
            }else{
                $("#url").show();
            }
        });

        $("#manufacturer").hide();
        //判断是全量推送还是单推
        form.on('radio(scope)', function(data){
            if(data.value == 1){
                $("#phone").show();
                $("#manufacturer").hide();
            }else{
                $("#phone").hide();
                $("#manufacturer").show();
            }
        });
    });


</script>
</html>