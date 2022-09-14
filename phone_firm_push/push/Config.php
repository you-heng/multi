<?php

class Config
{
    // 小米推送的key
    static public $xm_app_id = "";
    static public $xm_app_key = "";
    static public $xm_app_secret = "";
    static public $xm_app_package = "";

    // 华为推送的key
    static public $hw_app_id = "";
    static public $hw_secret_key = "";
    static public $hw_open_token = "https://oauth-login.cloud.huawei.com/oauth2/v3/token"; // token
    static public $hw_open_push = "https://push-api.cloud.huawei.com/v1/"; // 推送
    static public $hw_token_count = 999; // 最大推送数量

    // oppo推送的key
    static public $oppo_app_id = "";
    static public $oppo_app_key = "";
    static public $oppo_app_secret = "";
    static public $oppo_master_secret = "";
    static public $oppo_open_url = "https://api.push.oppomobile.com";
    static public $oppo_auth_api = "/server/v1/auth"; // 鉴权
    static public $oppo_open_push = "/server/v1/message/notification/unicast"; // 单推
    static public $oppo_open_all = "/server/v1/message/notification/broadcast"; // 全推
    static public $oppo_message_id = "/server/v1/message/notification/save_message_content"; // 生成消息id
    static public $oppo_token_count = 999; // 最大推送数量

    // vivo推送的key
    static public $vivo_app_id = "";
    static public $vivo_app_key = "";
    static public $vivo_app_secret = "";
    static public $vivo_open_url = "https://api-push.vivo.com.cn";
    static public $vivo_push_auth = "/message/auth"; // 鉴权
    static public $vivo_open_push = "/message/send"; // 单推
    static public $vivo_open_all = "/message/all"; // 全推
    static public $vivo_message_id = "/message/saveListPayload"; // 生成消息id

    // 魅族推送的key
    static public $mz_app_id = "";
    static public $mz_app_key = "";
    static public $mz_app_secret = "";
    static public $mz_open_url = "https://server-api-push.meizu.com/"; // 地址
    static public $mz_open_push = "/garcia/api/server/push/varnished/pushByPushId"; // 单推
    static public $mz_open_all = "/garcia/api/server/push/pushTask/pushToApp"; // 全推
}