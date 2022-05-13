<?php
require_once dirname(__FILE__) . '/../Config.php';
include_once(dirname(__FILE__) . '/autoload.php');

use xmpush\Builder;
use xmpush\Constants;
use xmpush\Sender;

class xiaomi
{
    /**
     * 单推
     * @param $data
     * @return bool
     */
    public static function Send($data)
    {
        // 常量设置必须在new Sender()方法之前调用
        Constants::setPackage(config::$xm_app_package);
        Constants::setSecret(config::$xm_app_secret);

        $sender = new Sender();
        $message = self::Type($data);
        $result = $sender->send($message, $data['regid'])->getRaw();
        if($result && $result['code'] == 0){
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
        // 常量设置必须在new Sender()方法之前调用
        Constants::setPackage(config::$xm_app_package);
        Constants::setSecret(config::$xm_app_secret);
        $sender = new Sender();
        $message = self::Type($data);
        $result = $sender->broadcastAll($message)->getRaw();
        if($result && $result['code'] == 0){
            return true;
        }
        return false;
    }

    /**
     * 点击类型
     * @param $data
     * @return Builder
     */
    private static function Type($data)
    {
        //1-打开app首页 2-打开app指定页面 3-打开指定网页
        if($data['click'] == 2){
            $message = self::Service([
                'title' => $data['title'],
                'content' => $data['content'],
                'payload' => '{"test":1,"ok":"It\'s a string"}'
            ]);
        }else if($data['click'] == 3){
            $message = self::Assigns([
                'title' => $data['title'],
                'content' => $data['content'],
                'payload' => '{"test":1,"ok":"It\'s a string"}',
                'url' => $data['url']
            ]);
        }else{
            $message = self::First([
                'title' => $data['title'],
                'content' => $data['content'],
                'payload' => '{"test":1,"ok":"It\'s a string"}'
            ]);
        }

        return $message;
    }

    /**
     * 打开首页
     * @param $data
     * @return Builder
     */
    private static function First($data)
    {
        // message1 演示自定义的点击行为
        $message1 = new Builder();
        $message1->title($data['title']);  // 通知栏的title
        $message1->description($data['content']); // 通知栏的description
        $message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($data['payload']); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message1->extra(Constants::EXTRA_PARAM_NOTIFY_EFFECT, Constants::NOTIFY_LAUNCHER_ACTIVITY); // 点击推送的时候设置打开APP
        $message1->notifyId(2); // 通知类型。同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message1->build();
        return $message1;
    }

    /**
     * 打开app指定页面
     * @param $data
     * @return Builder
     */
    private static function Service($data)
    {
        // message1 演示自定义的点击行为
        $message1 = new Builder();
        $message1->title($data['title']);  // 通知栏的title
        $message1->description($data['content']); // 通知栏的description
        $message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($data['payload']); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message1->extra(Constants::EXTRA_PARAM_NOTIFY_EFFECT, Constants::NOTIFY_ACTIVITY); // 点击推送的时候设置打开APP指定页
        $message1->extra(Constants::EXTRA_PARAM_INTENT_URI, $data['url']); // 点击推送的时候设置打开APP指定页
        $message1->notifyId(2); // 通知类型。同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message1->build();
        return $message1;
    }

    /**
     * 打开指定网页
     * @param $data
     * @return Builder
     */
    private static function Assigns($data)
    {
        // message1 演示自定义的点击行为
        $message1 = new Builder();
        $message1->title($data['title']);  // 通知栏的title
        $message1->description($data['content']); // 通知栏的description
        $message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($data['payload']); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message1->extra(Constants::EXTRA_PARAM_NOTIFY_EFFECT, Constants::NOTIFY_ACTIVITY); // 点击推送的时候设置打开APP指定页
        $message1->extra(Constants::EXTRA_PARAM_INTENT_URI, $data['url']); // 点击推送的时候设置打开APP指定页
        $message1->notifyId(2); // 通知类型。同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message1->build();
        return $message1;
    }
}