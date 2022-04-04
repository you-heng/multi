<?php
$data = $_GET;
if (isset($data['page'])) {
    $page = $data['page'];
    if ($page <= 20) {
        $path = './'.$data['type'].'/' . $page . '.json';
        if (file_exists($path)) {
            $res = file_get_contents($path);
            echo $res;
        } else {
            echo json_encode(['state' => 1, 'msg' => "获取推荐成功", 'data' => []]);
        }
    } else {
        echo json_encode(['state' => 1, 'msg' => "获取推荐成功", 'data' => []]);
    }
} else {
    echo json_encode(['state' => 1, 'msg' => "获取推荐成功", 'data' => []]);
}