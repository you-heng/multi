<?php
require_once dirname(__FILE__) . '/../Config.php';

class vivo
{
    /**
     * 单推
     * @param $data
     * @return bool
     */
    public static function Send($data)
    {
        $result = json_decode(self::Request([
            'url' => Config::$vivo_open_url . Config::$vivo_open_push,
            'header' => self::getHeader(),
            'postData' => json_encode(self::getMessage($data))
        ]), true);
        if($result['result'] == 0){
            return true;
        }
        return false;
    }

    /**
     * 全推
     * @param $data
     * @return bool
     */
    public static function Entire($data)
    {
        $result = json_decode(self::Request([
            'url' => Config::$vivo_open_url . Config::$vivo_open_all,
            'header' => self::getHeader(),
            'postData' => self::getMessage($data)
        ]), true);
        if($result && $result['result'] == 0){
            return true;
        }
        return false;
    }

    /**
     * 批量推送
     * @param $data
     * @return bool
     */
    public static function Batch($data)
    {
        $result = json_decode(self::Request([
            'url' => Config::$vivo_open_url . Config::$vivo_batch_push,
            'header' => self::getHeader(),
            'postData' => [
                'taskId' => self::getMessageId($data),
                'regIds' => $data['token'],
                'requestId' => self::getAccessToken()
            ],
        ]), true);
        if($result && $result['result'] == 0){
            return true;
        }
        return false;
    }

    /**
     * 获取消息id
     * @param $data
     * @return false|string
     */
    private static function getMessageId($data)
    {
        $result = json_decode(self::Request([
            'url' => Config::$vivo_open_url . Config::$vivo_message_id,
            'header' => self::getHeader(),
            'postData' => self::getMessage($data)
        ]), true);
        if($result && $result['result'] == 0 && isset($result['taskId'])){
            return $result['taskId'];
        }
        return false;
    }

    /**
     * 构造消息体
     * @param $data
     * @return array
     */
    private static function getMessage($data)
    {
        $result = [
            'regId' => $data['regid'],
            'notifyType' => 4, //通知类型 1:无，2:响铃，3:振动，4:响铃和振动
            'title' => $data['title'],
            'content' => $data['content'],
            'timeToLive' => 86400 * 7,
            'requestId' => self::getAccessToken(),
            'pushMode' => 1 // 0：正式推送；1：测试推送，不填默认为0
        ];

        // 1-打开app首页 2-打开app指定页面 3-打开指定网页
        // skipType 点击跳转类型 1：打开APP首页 2：打开链接 3：自定义 4:打开app内指定页面
        if($data['click'] == 1){
            $result['skipType'] = 1;
            $result['skipContent'] = $data['content'];
        }else{
            $result['skipType'] = 4;
            $result['skipContent'] = $data['url'];
        }

        return $result;
    }

    /**
     * 获取 header
     * @return array|string[]
     */
    private static function getHeader()
    {
        $accessToken = self::getAccessToken();
        if(!$accessToken) return [];
        return ['Content-Type:application/json; charset=utf-8','authToken:' . $accessToken];
    }

    /**
     * 获取 accessToken
     * @param $data
     * @return false|mixed|string
     */
    private static function getAccessToken()
    {
        $cacheInfo = json_decode(file_get_contents(dirname(__FILE__) . "/access_token.txt"), true);
        if($cacheInfo['expire_time'] < time()){
            $postData = [
                'appId' => Config::$vivo_app_id,
                'appKey' => Config::$vivo_app_key,
                'timestamp' => self::Timestamp()
            ];
            $postData['sign'] = self::Sign($postData);
            $result = json_decode(self::Request([
                'url' => Config::$vivo_open_url . Config::$vivo_push_auth,
                'header' => 'Content-Type:application/json; charset=utf-8',
                'postData' => json_encode($postData)
            ]), true);
            $accessToken = false;
            if($result['result'] == 0){ $accessToken = $result['authToken']; }
            if($accessToken){
                $cacheInfo = [];
                $cacheInfo['expire_time'] = time() + 86000;
                $cacheInfo['access_token'] = $accessToken;
                file_put_contents(dirname(__FILE__) . "/access_token.txt", json_encode($cacheInfo));
            }
        }else{
            $accessToken = $cacheInfo['access_token'];
        }
        return $accessToken;
    }

    /**
     * 请求
     * @param $data
     * @return false|string
     */
    private static function Request($data)
    {
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => $data['header'],
                'content' => $data['postData'],
                'timeout' => 60
            )
        );
        $context = stream_context_create($options);
        return file_get_contents($data['url'], false, $context);
    }

    /**
     * 签名
     * @param $data
     * @return string
     */
    private static function Sign($data)
    {
        $params = '';
        foreach($data as $v){
            $params .= $v;
        }
        $params .= Config::$vivo_app_secret;
        return strtolower(md5($params));
    }

    /**
     * 时间戳
     * @return float
     */
    private static function Timestamp()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}