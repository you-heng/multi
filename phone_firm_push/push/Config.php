<?php

class Config
{
    // 小米推送的key
    static public $xm_app_id = "2882303761520155896";
    static public $xm_app_key = "5152015529896";
    static public $xm_app_secret = "QgHJuGcI8Jt87GQD2FnXgA==";
    static public $xm_app_package = "com.baicaoshijia.notifydemo";

    // 华为推送的key
    static public $hw_app_id = "106189697";
    static public $hw_secret_key = "4596c040ce74828bad80e8a68e279e24a3ede5c4b5d6518536daf9ded8f2f5f4";
    static public $hw_open_token = "https://oauth-login.cloud.huawei.com/oauth2/v3/token"; // token
    static public $hw_open_push = "https://push-api.cloud.huawei.com/v1/"; // 推送
    static public $hw_token_count = 999; // 最大推送数量

    // oppo推送的key
    static public $oppo_app_id = "30810017";
    static public $oppo_app_key = "e905e54aa9b64390a99488c8d5965d5b";
    static public $oppo_app_secret = "336e60304cef43738ef4912045ae41fe";
    static public $oppo_master_secret = "4045186e8d914cddb55cca4a2cab7b63";
    static public $oppo_open_url = "https://api.push.oppomobile.com";
    static public $oppo_auth_api = "/server/v1/auth"; // 鉴权
    static public $oppo_open_push = "/server/v1/message/notification/unicast"; // 单推
    static public $oppo_open_all = "/server/v1/message/notification/broadcast"; // 全推
    static public $oppo_message_id = "/server/v1/message/notification/save_message_content"; // 生成消息id
    static public $oppo_token_count = 999; // 最大推送数量

    // vivo推送的key
    static public $vivo_app_id = "105559831";
    static public $vivo_app_key = "fd050e582510921c8020da611fcae52f";
    static public $vivo_app_secret = "0c00789f-0aef-43e0-b5f2-89e8d7efacc5";
    static public $vivo_open_url = "https://api-push.vivo.com.cn";
    static public $vivo_push_auth = "/message/auth"; // 鉴权
    static public $vivo_open_push = "/message/send"; // 单推
    static public $vivo_open_all = "/message/all"; // 全推
    static public $vivo_message_id = "/message/saveListPayload"; // 生成消息id

    // 魅族推送的key
    static public $mz_app_id = "3315055";
    static public $mz_app_key = "84166166ef9942e8b588ed8d6e657ef6";
    static public $mz_app_secret = "WFSq6x6bRmQ7PgyeuQ7TtTHRMevLRqDk";
    static public $mz_open_url = "https://server-api-push.meizu.com/"; // 地址
    static public $mz_open_push = "/garcia/api/server/push/varnished/pushByPushId"; // 单推
    static public $mz_open_all = "/garcia/api/server/push/pushTask/pushToApp"; // 全推

    // 推送系统账号密码
    static public $username = "xianqi";
    static public $password = "Yayi2020";
}