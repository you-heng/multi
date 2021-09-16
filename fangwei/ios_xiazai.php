<?php
//如果cookie不存在就跳转客服页面
if($_COOKIE['weixin'] !== 'weixin'){
    //如果教程不存在就跳转到
    header("Location: http://app.baicaoshijia.cn");
}

//如果是微信浏览器
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {  
    header("Location: http://baicaoshijia.xianqi.mobi/");
}else{ //echo "其他";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="img/touch-icon-iphone.png">
    <link rel="stylesheet" type="text/css" href="https://x.xianqi.mobi/cdn/common/common.css">
    <script src="https://x.xianqi.mobi/cdn/jquery/jquery-3.5.1.min.js"></script>
    <title>佰草世家</title>
    <style>
        body {
            background-color: #b4e41c;
            letter-spacing: 5px;
        }
        .xiazai{
            margin-top: 13vh;
            margin-left: 8vw;
        }
        .xiazai_one{
            font-size: 1.2rem;
            font-style: italic;
            font-weight: 600;
            margin-bottom: 8vh;
        }
        .xiazai_one_haoping{
            margin-bottom: 5vh;
        }
        .xiazai_one_xiazai{
            background-color: red;
            padding: 8px 23px;
            color: #f5ff01;
        }
        .xiazai_two{
            font-size: 1.1rem;
            color: #0035ff;
            margin-bottom: 10vh;
        }
        .xiazai_two p{
            margin-bottom: 10px;
        }
        .xiazai_three{
            font-size: 1.3rem;
        }
        .xiazai_three_click{
            color: red;
            font-size: 1.4rem;
            font-weight: 700;
        }
        .xiazai_four{
            text-align: right;
            margin-right: 14vw;
        }
        .h1_logo{
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="xiazai">
        <div class="xiazai_one">
            <div class="xiazai_one_haoping">参加好评返现，</div>
            <div class="xiazai_one_haoping">请将这个网页保存到手机桌面，</div>
            <div class="xiazai_one_haoping">然后再次打开，就可以联系我们！</div>
            <!-- <div>
                <span>请点击这里</span>
                <span>-></span>
                <span class="xiazai_one_xiazai" onclick='location="http://app.baicaoshijia.cn"'>联系我们</span>
            </div> -->
        </div>
        <div class="xiazai_two">
            <p>除了好评返现，</p>
            <p>还有千元红包，</p>
            <p>人人有份，</p>
            <p>百分百能拿到！</p>
            <p>老板为了推广APP下了血本！</p>
        </div>
        <div class="xiazai_three">
            <p>不懂怎么联系我们？</p>
            <p>可以点击这里查看<span class="xiazai_three_click" onclick='location="ios_jiaocheng2.php"'>视频教程</span></p>
        </div>
        <div class="xiazai_four"><img src="img/shou.png" alt=""></div>
    </div>
</body>
</html>
<?php  } ?>