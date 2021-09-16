<?php
include("head.php");
include "api/config.php";
session_start();
$username = $_SESSION['username'];
$is_role = $_SESSION['is_role'];
include 'api/datebase.php';
if($is_role == 1 || $is_role == 0){
    $table= 'p_admin';
    $serialNumber = '工号';
}else if($is_role == 2){
    $table = 'p_teacher';
    $serialNumber = '工号';
}else if($is_role == 3){
    $table = 'p_student';
    $serialNumber = '学号';
}

$sql = "SELECT * FROM {$table} WHERE username='{$username}'";
$result = $link->query($sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM p_college";
$result = $link->query($sql);
$college = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM p_group";
$result = $link->query($sql);
$group = mysqli_fetch_all($result,MYSQLI_ASSOC);

if($is_role == 3 && $user[0]['ts_id'] != null){
    $sql = "SELECT task_name FROM p_task where id=". $user[0]['ts_id'];
    $result = $link->query($sql);
    $task = mysqli_fetch_all($result,MYSQLI_ASSOC);
}
$link->close();

foreach($user as $k => $v){
    $user[$k]['role'] = $config['role'][$v['is_role']];
    $user[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
    $user[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
    foreach($college as $key => $val){
        if($val['id'] == $v['b_id']){
            $user[$k]['college'] = $val['name'];
        }
    }
    foreach($group as $key => $val){
        if($val['id'] == $v['g_id']){
            $user[$k]['group'] = $val['group_name'];
        }
    }
}
?>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">系统</a>
            <a href="">我的信息</a>
            <a>
              <cite>我的</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-fluid" style="padding-top: 50px">
                    <div class="layui-row">
                        <form class="layui-form">
                            <input type="hidden" id="id" name="id" value="<?php echo $user[0]['id'] ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>用户名
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="username" name="username" value="<?php echo $username ?>" autocomplete="off" lay-verify="required" required class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red"></span>密码
                                </label>
                                <div class="layui-input-inline">
                                    <input type="password" id="password" name="password"  autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span><?php echo $serialNumber ?>
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="serialNumber" name="serialNumber" value="<?php echo $user[0]['serialNumber'] ?>" autocomplete="off" lay-verify="required" required class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <?php if($is_role == 3){ ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red"></span>所属组
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="group" name="group" disabled value="<?php echo $user[0]['group'] ?>" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red"></span>我的课题
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="task" name="task" disabled value="<?php echo $task[0]['task_name'] ?>" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>邮箱
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="email" name="email" value="<?php echo $user[0]['email'] ?>" autocomplete="off" lay-verify="required" required class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>手机号
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="phone" name="phone" value="<?php echo $user[0]['phone'] ?>" autocomplete="off" lay-verify="required" required class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red"></span>身份
                                </label>
                                <div class="layui-input-inline">
                                    <input type="text" id="role" disabled name="role" value="<?php echo $user[0]['role'] ?>" autocomplete="off"  class="layui-input">
                                    <input type="hidden" id="is_role" disabled name="is_role" value="<?php echo $user[0]['is_role'] ?>" autocomplete="off"  class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                </div>
                            </div>
                            <?php if($is_role != 0){ ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                    <span class="x-red">*</span>院系
                                </label>
                                <div class="layui-input-inline">
                                    <select name="b_id" lay-verify="required" lay-search>
                                        <?php foreach($college as $k => $v){ ?>
                                            <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                </label>
                                <button  class="layui-btn" lay-filter="add" onclick="return false;" lay-submit="">
                                    修改
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['form', 'layer'], function() {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data) {
            $.post('./api/user.php',{data:data.field},(res)=>{
                let data = JSON.parse(res);
                layer.msg(data.msg);
                if(data.code == 0){
                    setTimeout(()=>{
                        // 可以对父窗口进行刷新
                        xadmin.reload();
                    },1000);
                }
            });
        });
    });
</script>
</html>