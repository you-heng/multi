<?php
//如果是微信浏览器
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://x.xianqi.mobi/cdn/common/common.css">
    <title>下载教程</title>
</head>
<body>
    <div style="width: 100%;height: 40px;color: #fff;background-color: red;text-align: center;line-height: 40px;font-size: 1.2rem;" onclick='location="index.php"'>点击返回上一页</div>
    <video style="width: 100%;height: 100%;" src="video/ios_jiaocheng1.mp4" controls="controls"></video>
    <!-- <div style="width: 100%;height: 40px;color: #fff;background-color: red;text-align: center;line-height: 40px;" onclick='location="index.php"'>点击返回上一页</div> -->
</body>
</html>
<?php
}else{ //echo "其他";  
    header("Location: ios_zhongzhuan.php");
} 
?>