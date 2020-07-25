<?php
session_start();
include "config.php";
$loginid = $_SESSION["login_id"];
$sql = "update login_detail set last_activity = now() where login_detail_id = '{$loginid}'";
$result = mysqli_query($conn, $sql) or die("Connection failedupdate");



?>