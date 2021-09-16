<?php
//载入composer自动加载文件
require './vendor/autoload.php';
//给类文件的命名空间起个别名
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/*$data = [
    [
        "id" => 1,
        "name" => "小明",
        "age" => "10"
    ],
    [
        "id" => 2,
        'name' => "小红",
        "age" => "11",
    ],
    [
        "id" => 3,
        "name" => "小黑",
        "age" => "12"
    ]
];*/

include './database.php';
$sql = "SELECT * FROM user WHERE is_sign = 1";
$result = $link->query($sql);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
$link->close();
foreach($data as $k => $v){
    $v['is_sign'] == 1 ? $data[$k]['sign'] = '已签到' : $data[$k]['sign'] = '未签到';
    $v['is_state'] == 1 ? $data[$k]['state'] = '学生' : $data[$k]['state'] = '教师';
    $data[$k]['login_time'] = date('Y-d-m H:i:s',$v['login_time']);
}

$fileName = '('.date("Y-m-d",time()) .'导出）';
//实例化spreadsheet对象
$spreadsheet = new Spreadsheet();
//获取活动工作簿
$sheet = $spreadsheet->getActiveSheet();
//设置单元格表头
$sheet->setCellValue('A1', 'id');
$sheet->setCellValue('B1', '姓名');
$sheet->setCellValue('C1', '学号');
$sheet->setCellValue('D1', '密码');
$sheet->setCellValue('E1', '是否签到');
$sheet->setCellValue('F1', '角色');
$sheet->setCellValue('G1', '登录时间');


$i=2;
foreach($data as $v){
    $sheet->SetCellValueByColumnAndRow('1',$i,$v['id']);
    $sheet->SetCellValueByColumnAndRow('2',$i,$v['name']);
    $sheet->SetCellValueByColumnAndRow('3',$i,$v['student']);
    $sheet->SetCellValueByColumnAndRow('4',$i,$v['pass']);
    $sheet->SetCellValueByColumnAndRow('5',$i,$v['sign']);
    $sheet->SetCellValueByColumnAndRow('6',$i,$v['state']);
    $sheet->SetCellValueByColumnAndRow('7',$i,$v['login_time']);
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