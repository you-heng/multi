<?php
include_once "../api/databases.php";

use think\facade\Db;

$uid = $_GET['uid'];
$tid = $_GET['tid'];
$chat = [];
if(!empty($uid)){
    $chat = Db::table('im_chat')->where(function ($query) use($uid){
        $query->where('f_id', $uid)->whereOr('t_id', $uid);
    })->whereOr(function ($query) use($tid){
        $query->where('f_id', $tid)->whereOr('t_id', $tid);
    })->limit(0, 100)->select()->toArray();
}else{
    echo "您的连接错误~";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://mi.anmixiu.com/cdn/layui/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="./lib/css/index.css"/>
    <title>移动客户端</title>
</head>
<body>
    <div class="layui-container-all">
        <div class="layui-row">
            <div class="layui-col-xs24 layui-col-sm12 layui-chat-up" id="chat-list">
                <?php foreach ($chat as $v){ ?>
                <?php if($tid == $v['f_id'] && $v['type'] == 1){ ?>
                <div class="layui-chat-left">
                    <!--  左侧聊天气泡  -->
                    <div class="layui-chat-left-title">
                        <div><?php echo $v['t_id']; ?></div>
                    </div>
                    <div class="layui-chat-left-content">
                        <span class="layui-chat-left-content-time"><?php echo $v['create_time']; ?></span>
                        <span class="layui-chat-left-content-neirong"><?php echo $v['text']; ?></span>
                    </div>
                </div>
                <?php }else if($tid == $v['f_id'] && $v['type'] == 2){ ?>
                <div class="layui-chat-left">
                    <div class="layui-chat-left-title">
                        <div><?php echo $v['t_id']; ?></div>
                    </div>
                    <div class="layui-chat-left-content">
                        <span class="layui-chat-left-content-time"><?php echo $v['create_time']; ?></span>
                        <div class="layui-chat-img">
                            <img src="<?php echo $v['text']; ?>"  alt="">
                        </div>
                    </div>
                </div>
                <?php }else if($uid == $v['f_id'] && $v['type'] == 1){ ?>
                <!--  右侧聊天气泡  -->
                <div class="layui-chat-right">
                    <div class="layui-chat-right-content">
                        <span class="layui-chat-right-content-time"><?php echo $v['create_time']; ?></span>
                        <span class="layui-chat-right-content-neirong"><?php echo $v['text']; ?></span>
                    </div>
                    <div class="layui-chat-right-title">
                        <div><?php echo $v['f_id']; ?></div>
                    </div>
                </div>
                <?php }else if($uid == $v['f_id'] && $v['type'] == 2){ ?>
                <div class="layui-chat-right">
                    <div class="layui-chat-right-content">
                        <span class="layui-chat-right-content-time"><?php echo $v['create_time']; ?></span>
                        <div class="layui-chat-img">
                            <img src="<?php echo $v['text']; ?>"  alt="">
                        </div>
                    </div>
                    <div class="layui-chat-right-title">
                        <div><?php echo $v['f_id']; ?></div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="layui-col-xs24 layui-col-sm12 layui-chat-down">
                <div class="layui-chat-upload" id="upload">
                    <i class="layui-icon layui-icon-picture layui-chat-upload-icon"></i>
                </div>
                <input type="text" id="content" name="content" required  lay-verify="required" placeholder="请输入内容" autocomplete="off" class="layui-input layui-chat-input">
                <button class="layui-btn layui-chat-btn" id="send">发送</button>
            </div>
        </div>
    </div>
</body>
<script src="http://mi.anmixiu.com/cdn/layui/layui.js"></script>
<script src="http://mi.anmixiu.com/cdn/jquery/jquery-3.6.0.js"></script>
<script>
    var layer,upload;
    var type = 1;
    layui.use(['layer', 'upload'], function (){
        layer = layui.layer;
        upload = layui.upload;

        var uploadInst = upload.render({
            elem: '#upload' //绑定元素
            ,url: '../api/upload.php' //上传接口
            ,done: function(res){
                //上传完毕回调
                type = 2;
                $("#content").val(res.data.src)
                console.log(res)
                submit()
            }
            ,error: function(){
                //请求异常回调
                layer.msg('上传失败')
            }
        });
    });

    var wsServer = 'ws://47.93.97.181:9502?uid=' + "<?php echo $uid; ?>";
    var websocket = new WebSocket(wsServer);

    websocket.onopen = function (evt) {
        console.log('连接成功');
    };

    websocket.onclose = function (evt) {
        console.log("关闭连接");
    };

    websocket.onmessage = function (evt) {
        let chat = JSON.parse(evt.data);
        var html = '';
        if(!chat.f_id) return false;
        if(chat.f_id != "<?php echo $uid; ?>"){
            if(chat.type === 1){
                html = `
                <div class="layui-chat-left">
                    <!--  左侧聊天气泡  -->
                    <div class="layui-chat-left-title">
                        <div>${chat.t_id}</div>
                    </div>
                    <div class="layui-chat-left-content">
                        <span class="layui-chat-left-content-time">${chat.create_time}</span>
                        <span class="layui-chat-left-content-neirong">${chat.text}</span>
                    </div>
                </div>
                `

            }else{
                html = `
                <div class="layui-chat-left">
                    <div class="layui-chat-left-title">
                        <div>${chat.t_id}</div>
                    </div>
                    <div class="layui-chat-left-content">
                        <span class="layui-chat-left-content-time">${chat.create_time}</span>
                        <div class="layui-chat-img">
                            <img src="${chat.text}"  alt="">
                        </div>
                    </div>
                </div>
                `
            }
        }else{
            if(chat.type === 1){
                html = `
                <div class="layui-chat-right">
                    <div class="layui-chat-right-content">
                        <span class="layui-chat-right-content-time">${chat.create_time}</span>
                        <span class="layui-chat-right-content-neirong">${chat.text}</span>
                    </div>
                    <div class="layui-chat-right-title">
                        <div>${chat.f_id}</div>
                    </div>
                </div>
                `
            }else{
                html = `
                <div class="layui-chat-right">
                    <div class="layui-chat-right-content">
                        <span class="layui-chat-right-content-time">${chat.create_time}</span>
                        <div class="layui-chat-img">
                            <img src="${chat.text}"  alt="">
                        </div>
                    </div>
                    <div class="layui-chat-right-title">
                        <div>${chat.f_id}</div>
                    </div>
                </div>
                `
            }
        }
        $("#chat-list").append(html);
        $("#content").val("")
    };

    websocket.onerror = function (evt, e) {
        console.log('连接错误' + evt.data);
    };

    $("#send").click(function () {
        submit()
    });

    $("#content").bind('keyup', function (event){
        if(event.keyCode == "13"){
            submit()
        }
    })

    function submit(){
        let text = $("#content").val()
        if(text !== ''){
            let chat = {
                f_id: "<?php echo $uid; ?>",
                t_id: "<?php echo $tid; ?>",
                type: type,
                text: $("#content").val()
            }
            websocket.send(JSON.stringify(chat))
        }else{
            layer.msg('请先输入内容');
        }
    }
</script>
</html>