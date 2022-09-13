<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://x.xianqi.mobi/cdn/layui/css/layui.css">
    <title>CDN</title>
    <style>
        .layui-overall{
            width: 100%;
            position: fixed;
            left: 20%;
            top: 10%;
        }
        .layui-list{
            width: 60%;
        }
        .layui-line{
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
        }
        .layui-width{
            width: 200px;
        }
    </style>
</head>
<body>
<div class="layui-row">
    <div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
        <div class="layui-overall">
            <div class="layui-list">
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>CDN列表</legend>
                </fieldset>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">layui.js</button>
                    <input type="text" id="layuijs" value="https://x.xianqi.mobi/cdn/layui/layui.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#layuijs">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">layui.css</button>
                    <input type="text" id="layuicss" value="https://x.xianqi.mobi/cdn/layui/css/layui.css" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#layuicss">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">layer.js</button>
                    <input type="text" id="layer" value="https://x.xianqi.mobi/cdn/layer/layer.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#layer">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">clipboard.js</button>
                    <input type="text" id="clipboard" value="https://x.xianqi.mobi/cdn/clipboard/clipboard.min.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#clipboard">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">jquery-3.5.1.js</button>
                    <input type="text" id="jquery35" value="https://x.xianqi.mobi/cdn/jquery/jquery-3.5.1.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#jquery35">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">jquery-3.5.1.min.js</button>
                    <input type="text" id="jquery35min" value="https://x.xianqi.mobi/cdn/jquery/jquery-3.5.1.min.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#jquery35min">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">vue2.6.js</button>
                    <input type="text" id="vue26" value="https://x.xianqi.mobi/cdn/vue/vue.min.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#vue26">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">vconsole.js</button>
                    <input type="text" id="vconsole" value="https://x.xianqi.mobi/cdn/js/vconsole.min.js" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#vconsole">点击复制</button>
                </div>
                <div class="layui-line">
                    <button class="layui-btn layui-btn-primary layui-border-green layui-width">公共css</button>
                    <input type="text" id="common" value="https://x.xianqi.mobi/cdn/common/common.css" class="layui-input">
                    <button type="button" class="layui-btn layui-width btn" data-clipboard-action="copy" data-clipboard-target="#common">点击复制</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://x.xianqi.mobi/cdn/layui/layui.js"></script>
<script src="https://x.xianqi.mobi/cdn/clipboard/clipboard.min.js"></script>
<script src="https://x.xianqi.mobi/cdn/js/vconsole.min.js"></script>
<script>
    new VConsole()

    layui.use('layer', function (){
        var layer = layui.layer;
        var clipboard = new ClipboardJS('.btn');
        // 成功之后的操作 ，清空选中
        clipboard.on('success', function (e) {
            layer.msg('复制成功')
        });
        // 失败的操作
        clipboard.on('error', function (e) {
            layer.msg('复制失败,请重新点击')
        });
    })
</script>
</html>