<?php
session_start();
if($_SESSION['is_role'] != 1 && $_SESSION['is_role'] != 0){
    echo json_encode(['code' => -1, 'msg' => '您的权限不足！']);
    return false;
}