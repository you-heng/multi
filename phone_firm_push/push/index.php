<?php
require_once dirname(__FILE__) . '/xiaomi/xiaomi.php';
require_once dirname(__FILE__) . '/vivo/vivo.php';
require_once dirname(__FILE__) . '/oppo/oppo.php';
require_once dirname(__FILE__) . '/meizu/meizu.php';
require_once dirname(__FILE__) . '/huawei/huawei.php';

class index
{
    /**
     * 推送接口
     */
    public function push()
    {
        $data = json_decode(file_get_contents('php://input'),true);
        $postData = $data;
        if($postData['scope'] == 1){
            $result = self::single($postData['userid']);
            if($result){
                $postData['regid'] = $result['regid'];
                self::firm($result['firm'], $postData);
            }
        }else{
            self::firm_all($postData);
        }
        echo json_encode(['code' => 0, 'msg' => '推送成功，请前往推送记录查看状态']);
    }

    /**
     * 全量推送
     * @param $data
     * @return bool
     */
    private static function firm_all($data)
    {
        for($i = 0; $i <= 5; $i++){
            if(array_key_exists('firm[huawei]',$data)){
                unset($data['firm[huawei]']);
                $count = self::count('huawei')['COUNT(*)'];
                $page = ceil($count / Config::$hw_token_count);
                for($i=1; $i<=$page; $i++){
                    $regid = self::entire('huawei', $i);
                    $data['token'] = $regid;
                    $result = self::huawei($data);
                    $state = $result == true ? 1 : 0;
                    self::storage($data,$state,'huawei');
                }
            }else if(array_key_exists('firm[oppo]',$data)){
                unset($data['firm[oppo]']);
                $count = self::count('oppo')['COUNT(*)'];
                $page = ceil($count / Config::$oppo_token_count);
                for($i=1; $i<=$page; $i++){
                    $data['token'] = implode(';', self::entire('oppo', $i));
                    $result = self::oppo($data);
                    $state = $result == true ? 1 : 0;
                    self::storage($data,$state,'oppo');
                }
            }else if(array_key_exists('firm[vivo]',$data)){
                // 全量推送
                unset($data['firm[vivo]']);
                $result = self::vivo($data);
                $state = $result == true ? 1 : 0;
                self::storage($data,$state,'vivo');

                // 批量推送
                /*unset($data['firm[vivo]']);
                $count = self::count('vivo')['COUNT(*)'];
                $page = ceil($count / Config::$vivo_token_count);
                for($i=1; $i<=$page; $i++){
                    $data['token'] = self::entire('vivo', $i);
                    $result = self::vivo($data);
                    $state = $result == true ? 1 : 0;
                    self::storage($data,$state,'vivo');
                }*/
            }else if(array_key_exists('firm[meizu]',$data)){
                unset($data['firm[meizu]']);
                $result = self::meizu($data);
                $state = $result == true ? 1 : 0;
                self::storage($data,$state,'meizu');
            }else if(array_key_exists('firm[xiaomi]',$data)){
                unset($data['firm[xiaomi]']);
                $result = self::xiaomi($data);
                $state = $result == true ? 1 : 0;
                self::storage($data,$state,'xiaomi');
            }
        }
        return true;
    }

    /**
     * 根据厂商单个推送
     * @param $firm
     * @param $data
     * @return bool
     */
    private static function firm($firm, $data)
    {
        $result = true;
        if($firm == 'xiaomi'){
            $result = self::xiaomi($data);
        }else if($firm == 'vivo'){
            $result = self::vivo($data);
        }else if($firm == 'oppo'){
            $result = self::oppo($data);
        }else if($firm == 'meizu'){
            $result = self::meizu($data);
        }else if($firm == 'huawei'){
            $data['token'][] = $data['regid'];
            $result = self::huawei($data);
        }
        // 入库推送记录
        self::storage($data, $result == true ? 1 : 0, $firm);
        return $result;
    }

    /**
     * 查询单个regid和对应的厂商
     * @param $regid
     * @return array|null
     */
    private static function single($userid)
    {
        include "./database.php";
        $sql = "SELECT regid, firm FROM `push_user` WHERE userid=" . $userid;
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return false;
    }


    /**
     * 总数量
     * @param $firm
     * @return false
     */
    private static function count($firm)
    {
        include "./database.php";
        $sql = "SELECT COUNT(*) FROM push_user WHERE firm='{$firm}'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return false;
    }

    /**
     * 查询一个厂商所有的regid (只有华为的全量推送才需要)
     * @param $firm
     * @return array|false|null
     */
    private static function entire($firm,$page)
    {
        include "./database.php";
        $limit = Config::$hw_token_count;
        $page = ($page - 1) * $limit;
        $sql = "SELECT regid FROM `push_user` WHERE firm='{$firm}' LIMIT {$page},{$limit}";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $regid = [];
            while ($s = $result->fetch_assoc()){
                 $regid[] = $s['regid'];
            }
            return $regid;
        }
        return false;
    }

    /**
     * 小米 推送
     * @param $data
     * @return bool
     */
    private static function xiaomi($data)
    {
        $result = false;
        if($data['scope'] == 1){
            $result = xiaomi::Send($data);
        }elseif ($data['scope'] == 2){
            $result = xiaomi::Entire($data);
        }
        return $result;
    }

    /**
     * vivo 推送
     * @param $data
     * @return bool
     */
    private static function vivo($data)
    {
        $result = false;
        if($data['scope'] == 1){
            $result = vivo::Send($data);
        }elseif ($data['scope'] == 2){
            $result = vivo::Entire($data);
            // $result = vivo::Batch($data);
        }
        return $result;
    }

    /**
     * oppo 推送
     * @param $data
     * @return bool
     */
    private static function oppo($data)
    {
        $result = false;
        if($data['scope'] == 1){
            $result = oppo::Send($data);
        }elseif ($data['scope'] == 2){
            $result = oppo::Entire($data);
        }
        return $result;
    }

    /**
     * meizu 推送
     * @param $data
     * @return bool
     */
    private static function meizu($data)
    {
        $result = false;
        if($data['scope'] == 1){
            $result = meizu::Send($data);
        }elseif ($data['scope'] == 2){
            $result = meizu::Entire($data);
        }
        return $result;
    }

    /**
     * huawei 推送
     * @param $data
     * @return bool
     */
    private static function huawei($data)
    {
        $result = huawei::Send($data);
        return $result;
    }

    /**
     * 入库
     * @param $data
     * @param $state
     * @param $firm
     * @return bool
     */
    private static function storage($data, $state, $firm)
    {
        include "./database.php";
        $url = $data['url'] == '' ? '' : $data['url'];
        $sql = "INSERT INTO `push_log`(`title`, `content`, `regid`, `click`, `url`, `scope`, `state`, `firm`) VALUES ('{$data['title']}','{$data['content']}','{$data['regid']}','{$data['click']}','{$url}','{$data['scope']}',{$state},'{$firm}')";
        mysqli_query($conn, $sql);
        return true;
    }
}

$push = new index();
$push->push();