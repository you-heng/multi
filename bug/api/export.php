<?php
//载入composer自动加载文件
require './vendor/autoload.php';
//给类文件的命名空间起个别名
use PhpOffice\PhpSpreadsheet\Spreadsheet;

include './datebase.php';
session_start();
$is_role = $_SESSION['is_role'];
$username = $_SESSION['username'];
if($is_role == 2 || $is_role ==3){
    $sql = "SELECT id FROM b_user WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $sql = "SELECT t1.*,t2.project_name,t3.username as put_name,t4.username as solve_name 
FROM b_bug AS t1 
LEFT JOIN b_project AS t2 ON t1.project_id=t2.id 
LEFT JOIN b_user as t3 ON t1.put_id=t3.id 
LEFT JOIN b_user as t4 ON t1.solve_id=t4.id
WHERE
(CASE
WHEN t1.is_role = 2 THEN t1.solve_id = {$user[0]['id']}
WHEN t1.is_role = 1 THEN t1.is_role = 1
END)
OR
(CASE
WHEN t1.is_role = 2 THEN t1.put_id = {$user[0]['id']}
WHEN t1.is_role = 1 THEN t1.is_role = 1
END)
ORDER BY t1.create_time DESC";
}else{
    $sql = "SELECT t1.*,t2.project_name,t3.username as put_name,t4.username as solve_name 
FROM b_bug AS t1 
LEFT JOIN b_project AS t2 ON t1.project_id=t2.id 
LEFT JOIN b_user as t3 ON t1.put_id=t3.id 
LEFT JOIN b_user as t4 ON t1.solve_id=t4.id
ORDER BY t1.create_time DESC";
}
$result = $link->query($sql);
$bug = mysqli_fetch_all($result,MYSQLI_ASSOC);
include './config.php';
foreach($bug as $k => $v){
    $bug[$k]['role'] = $config['role'][$v['is_role']];
    $bug[$k]['state'] = $config['state'][$v['is_state']];
    $bug[$k]['type'] = $config['type'][$v['is_type']];
    $bug[$k]['weight'] = $config['weight'][$v['is_weight']];
    $bug[$k]['priority'] = $config['priority'][$v['is_priority']];
    $bug[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $bug[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
}
$link->close();

$fileName = '('.date("Y-m-d",time()) .'导出）';
//实例化spreadsheet对象
$spreadsheet = new Spreadsheet();
//获取活动工作簿
$sheet = $spreadsheet->getActiveSheet();
//设置单元格表头
$sheet->setCellValue('A1', 'id');
$sheet->setCellValue('B1', '报告标题');
$sheet->setCellValue('C1', '提交人');
$sheet->setCellValue('D1', '项目名');
$sheet->setCellValue('E1', '解决人');
$sheet->setCellValue('F1', '状态');
$sheet->setCellValue('G1', '权限');
$sheet->setCellValue('H1', '优先级');
$sheet->setCellValue('I1', '问题类型');
$sheet->setCellValue('J1', '图片');
$sheet->setCellValue('K1', '问题所在系统');
$sheet->setCellValue('L1', '系统版本');
$sheet->setCellValue('M1', '报告详情');
$sheet->setCellValue('N1', '严重程度');
$sheet->setCellValue('O1', '创建时间');
$sheet->setCellValue('P1', '修改时间');


$i=2;
foreach($bug as $v){
    $sheet->SetCellValueByColumnAndRow('1',$i,$v['id']);
    $sheet->SetCellValueByColumnAndRow('2',$i,$v['bug_title']);
    $sheet->SetCellValueByColumnAndRow('3',$i,$v['put_name']);
    $sheet->SetCellValueByColumnAndRow('4',$i,$v['project_name']);
    $sheet->SetCellValueByColumnAndRow('5',$i,$v['solve_name']);
    $sheet->SetCellValueByColumnAndRow('6',$i,$v['state']);
    $sheet->SetCellValueByColumnAndRow('7',$i,$v['role']);
    $sheet->SetCellValueByColumnAndRow('8',$i,$v['priority']);
    $sheet->SetCellValueByColumnAndRow('9',$i,$v['type']);
    $sheet->SetCellValueByColumnAndRow('10',$i,$v['bug_img']);
    $sheet->SetCellValueByColumnAndRow('11',$i,$v['system']);
    $sheet->SetCellValueByColumnAndRow('12',$i,$v['system_ver']);
    $sheet->SetCellValueByColumnAndRow('13',$i,$v['bug_desc']);
    $sheet->SetCellValueByColumnAndRow('14',$i,$v['weight']);
    $sheet->SetCellValueByColumnAndRow('15',$i,$v['create_time']);
    $sheet->SetCellValueByColumnAndRow('16',$i,$v['update_time']);
    $i++;
}

//MIME协议，文件的类型，不设置描绘默认html
header('Content-Type:application/vnd.openxmlformats-officedoument.spreadsheetml.sheet');
//MIME 协议的扩展
header("Content-Disposition:attachment;filename={$fileName}.xlsx");
//缓存控制
header('Cache-Control:max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet,'Xlsx');
$writer->save('php://output');


?>