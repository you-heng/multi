<?php
//如果是微信浏览器
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {  ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>请选择用浏览器打开</title>
    </head>
    <body>
        <body style="margin: 0;padding: 0;width: 100vw;height: 100vh">
            <img style="width: 100vw;height: 100vh;z-index: -1;" src="img/weixin.gif" alt="" src="" alt="">
        </body>
    </body>
    </html>
    <?php
}else{ //echo "其他";  ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset=UTF-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width,
		initial-scale=1.0,
		maximum-scale=1.0,
		user-scalable=no">
        <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
        <title>下载</title>
    </head>
    <body></body>
    <script type="text/javascript">
        location.href = 'ios_zhongzhuan.php';
    </script>
    </html>

<?php  } ?>
