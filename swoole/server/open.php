<?php
class open{
    private $ws = null;
    public function __construct(){
        $this -> ws = new Swoole\WebSocket\Server("0.0.0.0", 9502);
        $this -> ws -> on('open', [$this, 'onOpen']);
        $this -> ws -> on('message', [$this, 'onMessage']);
        $this -> ws -> on('close', [$this, 'onClose']);
        $this -> ws -> start();
    }

    public function onOpen($ws, $request){
        var_dump($request->fd, $request->get, $request->server);
        $ws->push($request->fd, "欢迎客户端: {$request->fd} \n");
    }

    public function onMessage($ws, $frame){
       echo "信息 --> {$frame -> data} \n";
       foreach($ws -> connections as $fd){
           if($fd == $frame -> fd){
               $ws -> push($fd, "我--> {$frame -> data}");
           }else{
               $ws -> push($fd, "对方--> {$frame -> data}");
           }
       }
    }

    public function onClose($ws, $fd){
        echo "关闭 ---> {$fd}";
        $ws -> push($fd, "{$fd} ---> 退出聊天");
    }
}
new open();
