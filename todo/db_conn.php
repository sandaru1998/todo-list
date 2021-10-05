<?php

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "todo_list";

try {
    $conn = new PDO("mysql:host=$sName;db_name=$db_name",
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
}catch (PDOException $e){
    echo "Connection Failed : ".$e->getMessage();
}
