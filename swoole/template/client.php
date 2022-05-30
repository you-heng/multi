<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://mi.anmixiu.com/cdn/layui/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="../lib/css/index.css"/>
    <title>PC客户端</title>
</head>
<body>
    <div class="layui-container">
        <div class="layui-client-title">
            <fieldset class="layui-elem-field layui-field-title">
                <legend>客户端</legend>
            </fieldset>
        </div>
        <div class="layui-row layui-client">
            <div class="layui-content-center">
                <div class="layui-send-title">用户名</div>
                <div class="layui-content-center-details">
                    <!--  左侧聊天气泡  -->
                    <div class="layui-send">
                        <div class="layui-send-client">
                            <span>客服</span>
                        </div>
                        <div class="layui-send-list">
                            <span class="layui-send-time">2022-05-28 17:56:00</span>
                            <span class="layui-send-content">消</span>
                        </div>
                    </div>
                    <div class="layui-send">
                        <div class="layui-send-client">
                            <span>客服</span>
                        </div>
                        <div class="layui-send-list">
                            <span class="layui-send-time">2022-05-28 17:56:00</span>
                            <div class="layui-send-img">
                                <img src="https://img2.baidu.com/it/u=731520187,1995849030&fm=253&fmt=auto&app=138&f=JPEG"  alt="">
                            </div>
                        </div>
                    </div>
                    <!--  右侧聊天气泡  -->
                    <div class="layui-send-right">
                        <div class="layui-send-right-list">
                            <span class="layui-send-right-time">2022-05-28 17:56:00</span>
                            <span class="layui-send-right-content">
                            消
                        </span>
                        </div>
                        <div class="layui-send-right-client">
                            <span>用户</span>
                        </div>
                    </div>
                    <div class="layui-send-right">
                        <div class="layui-send-right-list">
                            <span class="layui-send-right-time">2022-05-28 17:56:00</span>
                            <div class="layui-send-img">
                                <img src="https://img2.baidu.com/it/u=731520187,1995849030&fm=253&fmt=auto&app=138&f=JPEG"  alt="">
                            </div>
                        </div>
                        <div class="layui-send-right-client">
                            <span>用户</span>
                        </div>
                    </div>

                </div>
                <div class="layui-content-center-send">
                    <div class="layui-content-center-send-uplod">
                        <i class="layui-icon layui-icon-picture"></i>
                    </div>
                    <div class="layui-content-center-send-input">
                        <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                    <button class="layui-btn layui-content-center-send-btn">发送</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="http://mi.anmixiu.com/cdn/layui/layui.js"></script>
</html>