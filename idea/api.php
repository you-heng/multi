<?php
$data = json_decode(file_get_contents('php://input'),true);
$postData = $data;

$conn = new mysqli('localhost', 'root', 'root', 'test.io');
mysqli_query($conn,"set names 'utf8'");

$sql = "INSERT INTO `idea` (`title`, `content`) VALUES ('{$postData['title']}','{$postData['content']}')";
$res = mysqli_query($conn, $sql);

echo json_encode(['code' => 0, 'msg' => '留言成功，谢谢']);