<?php
session_start();
include "config.php";
$id = $_SESSION["username"];
$output = "";
$sql = "select * from login where username != '{$id}'";
$result = mysqli_query($conn, $sql) or die("connection failedfetch");

if(mysqli_num_rows($result)>0){
    
    $output .="<table class='table'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>user</th>
        <th scope='col'>Status</th>
        <th scope='col'>Action</th>
      </tr>
    </thead>
    <tbody>";
  while($rows = mysqli_fetch_assoc($result)){
    $status = '';
    $current_timestamp = strtotime(date('Y-m-d H:i:s') . '-10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($rows['user_id'], $conn);
    if($user_last_activity>$current_timestamp){
        $status .="<button type='button' class='btn btn-success'>online</button>";
    }

    else{
        $status .="<button type='button' class='btn btn-danger'>offline</button>";
    }
        $output .= "<tr>     
        <th scope='row'> {$rows["user_id"]}</th>
                        <th>{$rows["username"]}</th>
                        <th>$status</th>
                        <th><button type='button' id='chatbtn' class='btn btn-primary' data-tousername='{$rows["username"]}' data-touserid='{$rows["user_id"]}' data-fromuserid='{$_SESSION["userid"]}' data-fromusername='{$_SESSION["username"]}'>Chat</button></th>
                        </tr>";
  }
  $output .="</tbody></table>";
}

echo $output;
?>