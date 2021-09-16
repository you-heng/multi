<?php
session_start();
$username = $_SESSION['username'];
$user['time'] = date('Y-m-d H:i:s',time());
$user['versions'] = '缺陷管理系统1.0';
$user['domain'] = $_SERVER['SERVER_NAME'];
$user['operating'] = php_uname();
$user['PHP_VERSION'] = PHP_VERSION;
$user['environment'] = php_uname().'/'.$_SERVER['SERVER_SOFTWARE'].'/php'.PHP_VERSION;
$user['way'] = php_sapi_name();
?>
<?php include("head.php"); ?>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <blockquote class="layui-elem-quote">欢迎管理员：
                        <span class="x-red"><?php echo $username ?></span>！当前时间:<?php echo $user['time'] ?>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">系统信息</div>
                <div class="layui-card-body ">
                    <table class="layui-table">
                        <tbody>
                        <tr>
                            <th>当前系统版本</th>
                            <td><?php echo $user['versions']; ?></td>
                        </tr>
                        <tr>
                            <th>服务器地址</th>
                            <td><?php echo $user['domain']; ?></td>
                        </tr>
                        <tr>
                            <th>操作系统</th>
                            <td><?php echo $user['operating']; ?></td>
                        </tr>
                        <tr>
                            <th>运行环境</th>
                            <td><?php echo $user['environment']; ?></td>
                        </tr>
                        <tr>
                            <th>PHP版本</th>
                            <td><?php echo $user['PHP_VERSION']; ?></td>
                        </tr>
                        <tr>
                            <th>PHP运行方式</th>
                            <td><?php echo $user['way']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>