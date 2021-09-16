<?php
function role($table,$page,$limit){
    include './datebase.php';
    session_start();
    $username = $_SESSION['username'];
    $is_role = $_SESSION['is_role'];
    if($is_role == 1){
        $sql = "SELECT t2.*,t3.username FROM p_admin AS t1 LEFT JOIN {$table} AS t2 ON t2.b_id=t1.b_id LEFT JOIN p_student AS t3 ON t3.id=t2.s_id WHERE t1.username='{$username}' limit {$page},{$limit}";
        $result = $link->query($sql);
        $res = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if($res[0]['id'] != NULL){
            $sql = "SELECT count(*) FROM {$table} WHERE b_id={$res[0]['b_id']}";
            $result = $link->query($sql);
            $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        $link->close();

        return $data = ['res' => $res, 'count' => $count];
    }else if($is_role == 2){
        $sql = "SELECT t2.*,t3.username FROM p_teacher AS t1 LEFT JOIN {$table} AS t2 ON t2.t_id=t1.id LEFT JOIN p_student AS t3 ON t2.s_id=t3.id WHERE t1.username='{$username}' limit {$page},{$limit}";
        $result = $link->query($sql);
        $res = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if($res[0]['id'] != NULL){
            $sql = "SELECT count(*) FROM {$table} WHERE t_id={$res[0]['t_id']}";
            $result = $link->query($sql);
            $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        $link->close();

        return $data = ['res' => $res, 'count' => $count];
    }else if($is_role == 3){
        $sql = "SELECT t1.username,t2.* FROM p_student AS t1 LEFT JOIN {$table} AS t2 ON t2.s_id=t1.id WHERE t1.username='{$username}' limit {$page},{$limit}";
        $result = $link->query($sql);
        $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
        if($res[0]['id'] != NULL){
            $sql = "SELECT count(*) FROM {$table} WHERE s_id={$res[0]['s_id']}";
            $result = $link->query($sql);
            $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        $link->close();

        return $data = ['res' => $res, 'count' => $count];
    }else if($is_role == 0){
        $sql = "SELECT t1.*,t2.username from {$table} AS t1 LEFT JOIN p_student AS t2 ON t1.s_id=t2.id LIMIT {$page},{$limit}";
        $result = $link->query($sql);
        $res = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if($res[0]['id'] != NULL){
            $sql = "SELECT count(*) FROM {$table}";
            $result = $link->query($sql);
            $count = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        $link->close();

        return $data = ['res' => $res, 'count' => $count];
    }
}

function judge($table){
    include './datebase.php';
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT id,b_id,t_id FROM p_student WHERE username='{$username}'";
    $result = $link->query($sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql = "SELECT * FROM {$table} WHERE s_id='{$user[0]['id']}'";
    $result = $link->query($sql);
    $paper = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $link->close();

    return $data = ['user' => $user, 'res' => $paper];
}
