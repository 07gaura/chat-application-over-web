<?php

    $conn = mysqli_connect('localhost', 'root', '', 'web_chat') or die("Connection not established");

    function fetch_user_last_activity($userid, $conn){
        $sql = "select * from login_detail where user_id='{$userid}'
        order by last_activity desc limit 1";
        $result = mysqli_query($conn, $sql) or die("connection failed fun");
        if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_assoc($result)){
                return $rows["last_activity"];
            }
        }
    }
?>