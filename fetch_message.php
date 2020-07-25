<?php

include "config.php";

$toid = $_POST['toid'];
$fromid = $_POST['fromid'];
$output = "";

$sql = "select * from chat_message where (to_user_id = '{$toid}' and from_user_id='{$fromid}') or (to_user_id = '{$fromid}' and from_user_id='{$toid}')";

$result = mysqli_query($conn, $sql) or die("connection failed in fetching messages");

if(mysqli_num_rows($result)>0){
    while($rows = mysqli_fetch_assoc($result)){
        $output .= "<div class='msg'>
        <i class='fa fa-user-circle' aria-hidden='true'></i>{$rows["from_username"]}
        <i>{$rows["time"]}</i>
        <p>{$rows["msg"]}</p>
        </div>";
    }
}
echo $output;

?>