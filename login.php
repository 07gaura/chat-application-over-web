<?php

include "config.php";

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "select * from login where username = '{$username}' and password = '{$password}'";
$result = mysqli_query($conn, $sql) or die ("Connection failed ");

if(mysqli_num_rows($result)!=0){
    while($rows=mysqli_fetch_assoc($result)){
    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["userid"] = $rows['user_id'];
    $userid = $rows["user_id"];
   $sql1 = "insert into login_detail(user_id) values('{$userid}')";
   if(mysqli_query($conn, $sql1) or die("Connection failed")){
    $_SESSION["login_id"] = mysqli_insert_id($conn);
   }
   
    header('Location: http://localhost/webchat/users.php');
}
}

else{
    echo "username or password is wrong";
}

?>