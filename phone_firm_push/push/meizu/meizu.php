<?php
require_once dirname(__FILE__) . '/../Config.php';

class meizu
{
    /**
     * 单推
     * @param $data
     * @return bool
     */
    public static function Send($data)
    {
        $postData = [
            'appId' => Config::$mz_app_id,
            'messageJson' => json_encode(self::getMessage($data)),
            'pushIds' => $data['regid']
        ];
        $postData['sign'] = self::Sign($postData);
        $result = self::Request(['postData' => $postData, 'url' => Config::$mz_open_url . Config::$mz_open_push]);
        if($result && $result['code'] == 200){
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
        $postData = [
            'appId' => Config::$mz_app_id,
            'messageJson' => json_encode(self::getMessage($data)),
            'pushType' => 0
        ];
        $postData['sign'] = self::Sign($postData);
        $result = self::Request(['postData' => $postData, 'url' => Config::$mz_open_url . Config::$mz_open_all]);
        if($result && $result['code'] == 200){
            return true;
        }
        return false;
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
                'header' => self::getHeader(),
                'content' => json_encode($data['postData']),
                'timeout' => 60
            )
        );
        $context = stream_context_create($options);
        return file_get_contents($data['url'], false, $context);
    }

    /**
     * 获取请求头
     * @return string[]
     */
    private static function getHeader()
    {
        return ["Content-Type:application/x-www-form-urlencoded;charset=UTF-8"];
    }

    /**
     * 构造消息体
     * @param $data
     * @return array
     */
    private static function getMessage($data)
    {
        $message = [
            'noticeBarInfo' => [
                'noticeBarType' => 2, //通知栏样式  0-标准 2-安卓原生
                'title' => $data['title'],  //推送标题
                'content' => $data['content'] //推送内容
            ],
            'noticeExpandInfo' => [
                'noticeExpandType' => 0 //展开方式 0-标准 1-文本
            ],
            'clickTypeInfo' => [
                'clickType' => $data['click'], // meizu: 0-打开应用 1-打开应用页面 2-打开url页面  xitong: 0-打开APP首页 1-打开APP指定页面 3-打开指定网页
                'url' => $data['url']
            ],
            'pushTimeInfo' => [
                'offLine' => 1,//是否进离线消息
                'validTime' => 72 //有效时长 1-72内的正整数 offLine=1时必填
            ],
            'advanceInfo' => [
                'suspend' => 1, //是否通知栏悬浮窗显示 0-不显示 1-显示
                'clearNoticeBar' => 1,//是否可清除通知栏 0-不可以 1-可以
                'fixDisplay' => 0,//是否定时展示 0-否 1-是
                'notificationType' => [
                    'vibrate' => 1, //震动
                    'lights' => 1, //闪光
                    'sound' => 1 //声音
                ]
            ]
        ];

        return $message;
    }

    /**
     * 生成签名
     * @param $data
     * @return string
     */
    private static function Sign($data)
    {
        $params = '';
        ksort($data);
        foreach($data as $k => $v){
            $params .= $k. '=' .$v;
        }
        $params .= Config::$mz_app_secret;
        return strtolower(md5($params));
    }
}