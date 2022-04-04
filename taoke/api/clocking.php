<?php
$data = $_GET;
if ($data['type'] === 'dapinke') {
    include_once "dapinke.php";
    for($i = 1; $i <= 10; $i++) {
        $result = getPinke($i);
        if ($result === false) $i--;
    }
} else if($data['type'] === 'dataoke') {
    include_once "dataoke.php";
    for($i = 1; $i <= 10; $i++) {
        $result = getTaoke($i);
        if ($result === false) $i--;
    }
} else if($data['type'] === 'taobeo') {
    include_once "taobao.php";
    for($i = 1; $i <= 10; $i++) {
        $result = getTaobao($i);
        if ($result === false) $i--;
    }
} else if($data['type'] === 'duoduo') {
    include_once "duoduo.php";
    for($i = 0; $i < 10; $i++) {
        $result = getDuoduo($i);
        if ($result === false) $i--;
    }
}