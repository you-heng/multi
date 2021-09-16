<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://x.xianqi.mobi/cdn/common/common.css">
    <script src="https://x.xianqi.mobi/cdn/jquery/jquery-3.5.1.min.js"></script>
    <title>佰草世家官方网站</title>
    <style>
        body {
            background-color: #f2f2f2;
        }
        .saoma {
            margin-top: 5vh;
            height: 80vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }
        .saoma_anniu {
            height: 8vh;
            width: 78vw;
            color: #fff;
            font-size: 1.2rem;
            text-align: center;
            line-height: 8vh;
            background-color: #009688;
            border-radius: 10px;
            box-shadow: 6px 6px 3px #ccc;
        }
        .tanchuang{
            position: fixed;
            top: 30vh;
            left: 7vw;
            width: 85vw;
            height: 30vh;
            box-sizing: border-box;
            background-color: #fff;
            font-size: 1.1rem;
            border-radius: 10px;
            padding: 20px;
            border: 3px solid #ff5722;
        }
        .tanchuang_text{
            margin-top: 20px;
        }
        .tanchuang_anniu{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .tanchuang_anniu span{
            margin-top: 20px;
            background-color: #ff5722;
            padding: 8px 20px;
            color: #fff;
            box-shadow: 3px 3px 3px #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="saoma">
        <span class="saoma_anniu" >好评返现</span>
        <span class="saoma_anniu">防伪查询</span>
        <span class="saoma_anniu">扫码兑奖</span>
        <span class="saoma_anniu">使用说明</span>
        <span class="saoma_anniu">联系售后</span>
    </div>
    
    <!-- 弹窗 -->
    <div class="tanchuang">
        <div class="tanchuang_text">由于微信限制，打开后必须选择用浏览器查看，不懂得可以点击查看教程</div>
        <div class="tanchuang_anniu">
            <!-- 如果是ios -->
            <?php  if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){  ?>
            <span onclick='location="ios_jiaocheng.php"'>继续跳转</span>
            <span onclick='location="ios_jiaocheng1.php"'>查看教程</span>
            <?php }else{ ?><!-- 其他浏览器 -->
            <span onclick='location="jiaocheng.php"'>继续跳转</span>
            <span onclick='location="jiaocheng1.php"'>查看教程</span>
            <?php } ?>
        </div>
    </div>
</body> 
<script>
    $(".tanchuang").hide();
    $(".saoma_anniu").click(function(){
        $(".tanchuang").show();
    });
</script>
</html>