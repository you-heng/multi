<?php
class uploading
{
    function index()
    {
        // 运行上传的图片类型
        $allowExt = ['jpeg','jpg','png','gif','wbmp','bmp'];
        $file = $_FILES['file'];
        $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
        // 判断是否是合法上传和真实的图片
        if($file['error']==0 && is_uploaded_file($file['tmp_name']) && in_array($ext,$allowExt) && getimagesize($file['tmp_name'])){
            $name = uniqid();
            $domain = $_SERVER['SERVER_NAME'];
            $src = 'http://'.$domain.'/bug/upload/'.date('Y',time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$name.'.'.$ext;
            $dir = '../upload/'.date('Y',time()).'/'.date('m',time()).'/'.date('d',time());
            if (!file_exists($dir)){
                mkdir ($dir,0755,true);
            }
            $name = $dir.'/'.$name.'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'],$name);
            echo json_encode(['code' => 0, 'data' => ['src' =>  $src ], 'msg' => 'Succeed']);
            return;
        }
        echo json_encode(['code' => -1]);
    }
}
$upload = new uploading();
echo $upload->index();