<?php
namespace service;

include_once __DIR__ . "/../config/databases.php";

use Cassandra\Varint;
use Swoole\WebSocket\Server;
use think\facade\Db;

class start
{
    private $ws = null;
    private $redis = null;
    public function __construct()
    {
        $this -> redis = new \Redis();
        $this -> redis -> connect('127.0.0.1', 6379);
        $this -> ws = new Server("0.0.0.0", 9502);
        $this -> ws -> set([
            "dispatch_mode" => 5
        ]);
        $this -> ws -> on('open', [$this, 'onOpen']);
        $this -> ws -> on('message', [$this, 'onMessage']);
        $this -> ws -> on('close', [$this, 'onClose']);
        $this -> ws -> start();
    }

    public function onOpen($ws, $request)
    {
        $ws->bind($request->fd, $request->get['uid']);
        $login = $this->login($request->get, $request->server['remote_addr'], $request->header['user-agent'], $request->fd);
        if($login){
            $fd = json_decode($this->redis->get($request->get['sid']), true)['fd'];
            $data = $this->query($request->get['uid']);
            $ws->push($fd, json_encode($data));
        }
    }

    public function onMessage($ws, $frame)
    {
        $data = json_decode($frame->data, true);
        $fd = $this->storage($data);
        $ws -> push($frame->fd, $frame->data);
        var_dump($fd);
        $ws -> push($fd, $frame->data);
    }

    public function onClose($ws, $fd)
    {
        $uid = $ws->getClientInfo($fd)['uid'];
        $data = json_decode($this->redis->get($uid), true);
        $result = $this->close($data);
        if($result){
            $ws -> push($data['sid'], $fd);
        }
    }

    /**
     * @param $uid
     * @return Db
     * 查询
     */
    public function query($uid)
    {
        $result = Db::table("im_user")->where(['uid' => $uid])->field('id,uid,unread')->find();
        return $result;
    }

    /**
     * @param $data
     * @param $ip
     * @param $ua
     * @param $fd
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 登录
     */
    public function login($data, $ip, $ua, $fd)
    {
        $data['fd'] = $fd;
        $this->redis->set($data['uid'], json_encode($data));
        $result = false;
        if($data['type'] == 1){
            Db::table("im_user")->where(['uid' => $data['uid']])->update(['ip' => $ip, 'ua' => $ua, 'fd' => $fd]);
            Db::table("im_service")->where(['uid' => $data['sid']])->inc('serve_num', 1)->inc('serve_count', 1)->update();
            $result = Db::table('im_service')->where(['is_line'])->field('is_line')->find()['is_line'] == 1 ? false : true;
        }else if($data['type'] == 2){
            var_dump($data);
            Db::table("im_service")->where(['uid' => $data['uid']])->update(['ip' => $ip, 'ua' => $ua, 'fd' => $fd, 'is_line' => 2]);
        }
        return $result;
    }

    /**
     * @param $data
     * @return mixed
     * 消息入库
     */
    public function storage($data)
    {
        $fd = null;
        Db::table("im_chat_log")->insert($data);
        $fd = json_decode($this->redis->get($data['t_id']), true)['fd'];
        return $fd;
    }

    /**
     * @param $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 退出
     */
    public function close($data)
    {
        $this->redis->del($data['uid']);
        $result = false;
        if($data['type'] == 1){
            Db::table("im_service")->where(['uid' => $data['sid']])->dec('serve_num', 1)->update();
            $result = Db::table('im_service')->where(['uid' => $data['sid']])->field('is_line')->find()['is_line'] == 1 ? false : true;
        }else if($data['type'] == 2){
            Db::table("im_service")->where(['uid' => $data['uid']])->update(['is_line' => 1]);
        }
        return $result;
    }
}

new start();