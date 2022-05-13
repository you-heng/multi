<?php
require_once dirname(__FILE__) . '/../Config.php';

class oppo
{
    /**
     * 单条推送
     * @param $data
     * @return bool
     */
    public static function Send($data)
    {
        $body = [
            'auth_token' => self::getAccessToken(),
            'message' => json_encode([
                'target_type' => 2, // 2-regid 5-别名
                'target_value' => $data['regid'], // regid值
                'notification' => self::getMessage($data)
            ])
        ];
        $result = json_decode(self::Request([
            'header' => self::getHeader(),
            'postData' => $body,
            'url' => Config::$oppo_open_url . Config::$oppo_open_push
        ]), true);
        if($result && $result['code'] == 0 && isset($result['data']['messageId'])){
            return true;
        }
        return false;
    }

    /**
     * 全量推送
     * @param $data
     * @return bool
     */
    public static function Entire($data)
    {
        $body = [
            'auth_token' => self::getAccessToken(),
            'message_id' => self::getMessageId($data),
            'target_type' => 2,
            'target_value' => $data['token']
        ];
        $result = json_decode(self::Request([
            'header' => self::getHeader(),
            'postData' => $body,
            'url' => Config::$oppo_open_url . Config::$oppo_open_all
        ]),true);
        if($result && $result['code'] == 0 && $result['data']['task_id']){
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
            'url' => Config::$oppo_open_url . Config::$oppo_message_id,
            'header' => self::getHeader(),
            'postData' => [
                'title' => $data['title'],
                'content' => $data['content']
            ],
        ]), true);
        if($result && $result['code'] == 0 && isset($result['data']['message_id'])){
            return $result['data']['message_id'];
        }
        return false;
    }

    /**
     * 获取头部
     * @return array|string[]
     */
    private static function getHeader()
    {
        $authToken = self::getAccessToken();
        if(!$authToken) return [];
        return ['Content-Type:application/x-www-form-urlencoded; charset=utf-8','auth_token:'.$authToken];
    }

    /**
     * 构造消息体
     * @param $data
     * @return array
     */
    private static function getMessage($data)
    {
        $result = [
            'app_message_id' => uniqid(),
            'title' => $data['title'],
            'content' => $data['content'],
            'off_line_ttl' => 86400 * 10
        ];
        //1-打开app首页 2-打开app指定页面 3-打开指定网页
        if($data['click'] == 1){
            $result['click_action_type'] = 0;
        }else{
            $result['click_action_type'] = 5;
            $result['click_action_url'] = $data['url'];
        }

        return $result;
    }

    /**
     * 获取token
     * @return false|mixed|string
     */
    private static function getAccessToken()
    {
        $cacheInfo = json_decode(file_get_contents(dirname(__FILE__) . "/access_token.txt"), true);
        if($cacheInfo['expire_time'] < time()){
            $postData = [
                'app_key' => Config::$oppo_app_key,
                'timestamp' => self::Timestamp()
            ];
            $postData['sign'] = self::Sign($postData);
            $result = json_decode(self::Request([
                'url' => Config::$oppo_open_url . Config::$oppo_auth_api,
                'postData' => $postData,
                'header' => 'Content-Type:application/x-www-form-urlencoded; charset=utf-8',
            ]), true);
            $accessToken = false;
            if($result['code'] == 0 && isset($result['data']['auth_token'])){
                $accessToken = $result['data']['auth_token'];
            }
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
                'content' => http_build_query($data['postData']),
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
        foreach ($data as $v){
            $params .= $v;
        }
        $params .= Config::$oppo_master_secret;
        return hash('sha256',$params);
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