<?php include("../head.php"); ?>
<?php
session_start();
$username = $_SESSION['username'];
?>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="./index.php">缺陷管理系统</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo $username ?></a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd><a href="../api/logout.php">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/"></a></li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="layui-icon iconfont left-nav-li" lay-tips="缺陷管理">&#xe64e;</i>
                    <cite>缺陷管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('缺陷报告','../bug-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>缺陷报告</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('缺陷报告操作记录','../bugLog-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>缺陷报告操作记录</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="layui-icon iconfont left-nav-li" lay-tips="我的信息">&#xe66f;</i>
                    <cite>我的信息</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('信息','../user-form.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>信息</cite>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>我的桌面
            </li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='../welcome.php' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
</body>
</html>