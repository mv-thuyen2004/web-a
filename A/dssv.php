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
    require('header.php');
    if (isset($_GET['idxoa'])){
    $ys=$_GET['idxoa'];
    $sql="DELETE FROM thongtinsinhvien WHERE `MSV` = $ys ";
    $result= $conn->query($sql);
    echo '
        <script>
          alert("bạn xóa sinh viên thành công ");
        </script> '; 
    }
    mysqli_set_charset($conn,'UTF8');
    $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop ";
    $result= $conn->query($sql);
?>


<div class="container mt-3">
  <h2>Danh Sách Sinh viên</h2>
              
  <table class="table table-striped">
    <thead>
      <tr>
        <th>MSV</th>
        <th>TÊN</th>
        <th>TÊN LỚP</th>
        <th>CHỨC NĂNG</TH>
      </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows>0) //kiem tra xem co gia tri khong
    {
        while($row=$result->fetch_assoc()) //doc tung dong cua ket qua
        {
            echo '<tr>';
            echo '<td>'. $row["MSV"].'</td>';
            echo '<td>'. $row['Ten'].'<?td>';
            echo ' <td>'.$row['TenLop'].'</td>';
            echo '</td>';
            echo "<td><a href='suasinhvien.php' style='text-decoration:none; color:green' >sửa    </a><a  href='dssv.php?idxoa=".$row['MSV']. "'style='text-decoration:none;color:red'>xóa</a></td>";
        


        }
    }
    else{
        echo 'no flight in database';
    }
    
    $conn->close();
?>
    </tbody>
  </table>
</div>
<a href='index.php' ><button id='add' class="btn btn-success" style="margin-left:50% " >add</button></a>
<a href='index.php'><button href="index.php" id="myButto" class="btn btn-secondary" >trở về</button></a>



</body>
</html>
