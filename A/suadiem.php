<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    require 'connection.php';
    session_start();
    

    require('header.php');
    echo "trang này sẽ sớm được hoàn thành";
    mysqli_set_charset($conn,'UTF8');
    $sql="";
                                         
    $result= $conn->query($sql);
    
?>
</body>
</html>