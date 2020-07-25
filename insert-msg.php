<?php

    include "config.php";

    $to = $_POST['to_id'];
    $tousername = $_POST['tousername'];
    $from = $_POST['from_id'];
    $fromusername = $_POST['fromusername'];
    $msg = $_POST['msg'];

    $sql = "insert into chat_message(to_user_id, to_username, from_user_id, from_username, msg)
    values('{$to}','{$tousername}', '{$from}', '{$fromusername}', '{$msg}')";
    if(mysqli_query($conn, $sql) or die("insert connection failed")){
        echo 1;
    }


?>