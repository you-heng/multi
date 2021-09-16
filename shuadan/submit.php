<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://x.xianqi.mobi/cdn/common/common.css">
    <link rel="stylesheet" href="https://x.xianqi.mobi/cdn/layui/css/layui.css">
    <title>提交</title>
</head>
<body>
    <ul class="layui-nav">
        <li class="layui-nav-item layui-this"><a href="">提交信息</a></li>
    </ul>
    <form class="layui-form" action="" style="padding: 40px 40px 0 0">
        <div class="lianjie">
            <div class="layui-form-item">
                <label class="layui-form-label">链接编号</label>
                <div class="layui-input-block">
                    <input type="text" name="id" id="id" lay-verify="id" autocomplete="off" placeholder="请输入链接编号" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">订单编号</label>
                <div class="layui-input-block">
                    <input type="text" name="number" id="number" lay-verify autocomplete="off" placeholder="请输入订单编号" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-inline">
                <button type="button" class="layui-btn layui-btn-primary layui-border-green" onclick="cloneLun(this)">增加链接</button>
                <button type="button" class="layui-btn layui-btn-primary layui-border-red" onclick="cloneLun(this)">删除链接</button>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" lay-submit lay-filter="demo">立即提交</button>
            </div>
        </div>
    </form>
</body>
<script src="https://x.xianqi.mobi/cdn/jquery/jquery-3.5.1.min.js"></script>
<script src="https://x.xianqi.mobi/cdn/layui/layui.js"></script>
<script>
    //克隆
    function cloneLun(ele) {
        var newInput = $(ele).html();
        if (newInput == '增加链接') {
            var newDiv = $('.lianjie').last().clone();
            if(newDiv.prevObject.prevObject.length < 10){
                $('.lianjie').last().after(newDiv);
            }
        } else {
            var newDiv = $('.lianjie').last().clone();
            if(newDiv.prevObject.prevObject.length >= 2){
                $('.lianjie').last().remove();
            }
        }
    }

    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(demo)', function(data){
            if(!data.field.id){ layer.msg('链接编号不能为空'); return; }
            if(!data.field.number){ layer.msg('订单编号不能为空'); return; }
            var formArray = $('form').serializeArray();
            let field = {};
            field.id = [];
            field.number = [];
            $.each(formArray,(index,item)=>{
                if(item.name == 'id'){
                    field.id.push(item.value);
                }else if(item.name == 'number'){
                    field.number.push(item.value);
                }
            });
            $.post('api/submit.php',{field},(res)=>{
                let result = JSON.parse(res);
                layer.msg(result.msg);
            });
        });
    });
</script>
</html>