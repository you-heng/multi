<?php 
header("Content-type:text/html;charset=utf-8");
// 连接数据库
$mysqli=new mysqli('127.0.0.1','app_ip','123456','app_ip');
// 设置数据库字符集
$mysqli->set_charset('utf8');
// 获取IP,UA,访问时间
$ip = $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$date = date("Y-m-d H:i:s");
// 查询数据表中是否有该IP
$query="SELECT ip FROM app_ip WHERE ip='{$ip}'";
$res=$mysqli->query($query);
$num=$res->num_rows;
// 不存在则插入IP
if($num==0){
  $insert="INSERT INTO app_ip(ip,ua,time) VALUES('{$ip}','{$ua}','{$date}')";
  $mysqli->query($insert);
}
// 关闭数据库连接
$mysqli->close();

header('location:https://www.baidu.com/'); 
?>

