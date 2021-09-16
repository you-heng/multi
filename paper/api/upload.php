<?php
class upload
{
    function index()
    {
        // 运行上传的图片类型
        $file = $_FILES['file'];
        $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
        $name = uniqid();
        $domain = $_SERVER['SERVER_NAME'];
        $src = 'http://'.$domain.'/upload/'.date('Y',time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$name.'.'.$ext;
        $dir = '../upload/'.date('Y',time()).'/'.date('m',time()).'/'.date('d',time());
        if (!file_exists($dir)){
            mkdir ($dir,0755,true);
        }
        $name = $dir.'/'.$name.'.'.$ext;
        move_uploaded_file($_FILES['file']['tmp_name'],$name);
        echo json_encode(['code' => 0, 'data' => ['src' =>  $src ], 'msg' => 'Succeed']);
        return;
    }
}
$upload = new upload();
echo $upload->index();