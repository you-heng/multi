<?php
include '../head.php';
include "../api/config.php";
$state = $_GET['state'];
session_start();
$username = $_SESSION['username'];
?>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="./index.php">论文管理系统</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo $username; ?></a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a href="<?php echo $config['path'] ?>api/logout.php">退出</a></dd>
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
                    <i class="iconfont left-nav-li layui-icon" lay-tips="订单管理">&#xe705;</i>
                    <cite>答辩管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('开题报告列表','../report-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>开题报告列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('课题列表','../task-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>课题列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('论文列表','../paper-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>论文列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('分组列表','../group-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分组列表</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li layui-icon" lay-tips="系统设置">&#xe716;</i>
                    <cite>系统设置</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('我的信息','../user-form.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>我的信息</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('下载文档','../stat-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>下载文档</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('通知管理','../notice-list.php')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>通知管理</cite></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
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
</body>
<script>
    if(<?php echo $state; ?> == 1){
        alert('请前往系统设置->我的信息中完善个人信息');
    }
</script>
</html>