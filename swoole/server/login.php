<?php
$data = json_decode(file_get_contents('php://input'),true);
echo json_encode(['code' => 0, 'msg' => '登录成功']);