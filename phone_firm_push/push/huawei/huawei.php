<?php
require_once dirname(__FILE__) . '/../Config.php';

class huawei
{
    /**
     * 推送
     * @param $data
     * @return bool
     */
    public static function Send($data)
    {
        $accessToken = self::getAccessToken();
        if(!$accessToken){ return false; }
        $result = json_decode(self::Request([
            'url' => Config::$hw_open_push . Config::$hw_app_id . "/messages:send",
            'postData' => json_encode(self::getMessage($data)),
            'header' => self::getHeader()
        ]), true);
        if($result && $result["msg"] == 'Success'){
            return true;
        }
        return false;
    }

    /**
     * 构造消息体
     * @param $data
     * @return array[]
     */
    private static function getMessage($data)
    {
        $result = [
            'validate_only' => false,
            'message' => [
                'android' => [
                    'notification' => [
                        'title' => $data['title'],
                        'body' => $data['content'],
                        'click_action' => []
                    ]
                ],
                'token' => $data['token']
            ]
        ];
        // click 1-打开首页 2-打开指定APP页面 3-打开指定网页
        // type 1-打开应用自定义页面 2-打开特定url 3-打开应用
        if($data['click'] == 2){
            $result["message"]["android"]["notification"]["click_action"]["type"] = 1;
            $result["message"]["android"]["notification"]["click_action"]["action"] = $data['url'];
        }else if($data['click'] == 3){
            $result["message"]["android"]["notification"]["click_action"]["type"] = 2;
            $result["message"]["android"]["notification"]["click_action"]["url"] = $data['url'];
        }else{
            $result["message"]["android"]["notification"]["click_action"]["type"] = 3;
        }

        return $result;
    }

    /**
     * 请求头
     * @return string[]
     */
    private static function getHeader()
    {
        return ['Content-Type: application/json; charset=UTF-8', 'Authorization: Bearer ' . self::getAccessToken()];
    }

    /**
     * 获取 accessToken
     * @return false|mixed|string
     */
    private static function getAccessToken()
    {
        $cacheInfo = json_decode(file_get_contents(dirname(__FILE__) . "/access_token.txt"),true);
        if(!isset($cacheInfo) && $cacheInfo['expire_time'] < time()) {
            $result = json_decode(self::Request([
                'postData' => http_build_query([
                    'grant_type' => 'client_credentials',
                    'client_id' => Config::$hw_app_id,
                    'client_secret' => Config::$hw_secret_key
                ]),
                'url' => Config::$hw_open_token,
                'header' => 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
            ]), true);
            $accessToken = false;
            if(isset($result['access_token']) && isset($result['expires_in'])){
                $accessToken = $result['access_token'];
            }
            if($accessToken) {
                $cacheInfo = [];
                $cacheInfo['expire_time'] = time() + 3500;
                $cacheInfo['access_token'] = $accessToken;
                file_put_contents(dirname(__FILE__) . "/access_token.txt", json_encode($cacheInfo));
            }
        } else {
            $accessToken = $cacheInfo['access_token'];
        }

        return $accessToken;
    }

    /**
     * 发请求
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
}