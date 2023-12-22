<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .thong_tin{
        border: 1px solid lightblue;
        border-radius: 5px;
        width: 25%;
        font-weight: bold;
       }
       span{
        padding: 10px;
       }
      
    </style>
</head>

<body>
<?php
require('header.php');
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
require('connection.php');
if (isset($_GET['MSV'])){
    $msv=$_GET['MSV'];

}
else{
$msv=$_SESSION['user'];}
mysqli_set_charset($conn, 'UTF8');
$sql = "SELECT  * FROM Thongtinsinhvien INNER JOIN Lop ON Thongtinsinhvien.IdLop = Lop.IdLop WHERE Thongtinsinhvien.MSV = '" . $msv . "'";
$result = $conn->query($sql);
?>


<div class="container mt-3">
    <h2>ĐIỂM SINH VIÊN</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            
            <body>

            <?php
            if ($result->num_rows > 0 ) {
                while ($row1 = $result->fetch_assoc()) {
                    echo '<div class="thong_tin">'. '<span>MSV:</span> ' . $row1["MSV"] . '</br>' . '<span>Tên sinh viên:</span> ' . $row1["Ten"]  . '</br>' . '<span>Lớp:</span> ' . $row1["MaLop"]  . '</br>' . '<span>Khóa học:</span> ' . $row1["KhoaHoc"] . '</div>';  
                }
            }
            ?>
            <?php

$sql2 = "SELECT  * FROM Diem INNER JOIN Mon ON Diem.IdMon = Mon.IdMon WHERE Diem.MSV = '" . $msv . "'";
$result2 = $conn->query($sql2);
?>
<div class="container mt-3">
 
    <div class="table-responsive">
        <table class="table table-bordered">
           
            <tr>
                <th style=" background-color: lightblue">IdMon</th>
                <th style=" background-color: lightblue">TenMon</th>
                <th style=" background-color: lightblue">TinChi</th>
                <th style=" background-color: lightblue">A</th>
                <th style=" background-color: lightblue">B</th>
                <th style=" background-color: lightblue">C</th>
                <th style=" background-color: lightblue">hệ 10</th>
                <th style=" background-color: lightblue">hệ 4</th>
                
            </tr>
        
            <?php
            if ($result2->num_rows > 0) {
                while (($row2 = $result2->fetch_assoc())) {
                    $he10= $row2["A"]* 0.6 + $row2["B"]*0.3 + $row2["C"]*0.1;
                    $he4=$he10/10*4;
                    
                    echo'<tr>
                            <td>' . $row2["IdMon"] . '</td>
                            <td>' . $row2["TenMon"] . '</td>
                            <td>' . $row2["TinChi"] . '</td>
                            <td>' . $row2["A"] . '</td>
                            <td>' . $row2["B"] . '</td>
                            <td>' . $row2["C"] . '</td>
                            <td>' . number_format($he10,2) . '</td>
                            <td>' . number_format($he4,2) . '</td>
                            
                          </tr>';
                }
            }          
            ?>
            
        </table>
    </div>
</div>
<?php
if ($_SESSION['quyen']==2){
    echo "<a href='dssv.php'><button class='btn btn-secondary' style='float:right '>danh sách sinh viên</button></a>";
}
?>
</body>
<?php
require('footer.php');?>
</html>

