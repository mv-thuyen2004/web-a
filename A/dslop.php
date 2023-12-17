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
    mysqli_set_charset($conn,'UTF8');
    if (isset($_GET['idxoa'])){
        $ys=$_GET['idxoa'];
        $sql="DELETE FROM lop WHERE `MaLop` = '$ys' ";
        $result= $conn->query($sql);
        echo '
            <script>
              alert("bạn xóa lớp thành công ");
            </script> '; 
        }
    $sql="SELECT `MaLop` , `TenLop`,`KhoaHoc` FROM lop  ";
    $result= $conn->query($sql);
?>


<div class="container mt-3">
  <h2>Danh Sách Sinh viên</h2>
              
  <table class="table table-striped">
    <thead>
      <tr>
        <th>MÃ LỚP</th>
        <th>TÊN LỚP</th>
        <th>KHÓA HỌC</th>
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
            echo '<td>'. $row["MaLop"].'</td>';
            echo '<td>'. $row['TenLop'].'<?td>';
            echo     ' <td>'.$row['KhoaHoc'].'</td>';
            echo '</td>';
            if($_SESSION['quyen']==1){
            echo "<td><a href='sualop.php' style='text-decoration:none; color:green' >sửa    </a><a href='dslop.php?idxoa=".$row['MaLop']. "' style='text-decoration:none;color:red'>xóa</a></td>";
            }
            else if ($_SESSION['quyen']==2){
              echo "<td><a href='dssv.php?malop=".$row['MaLop']. "' style='text-decoration:none;color:red'>danh sách sinh viên</a></td>";
            
            
            }
        


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
<?php
if ($_SESSION['quyen']==1){
  echo "
<a href='themlop.php' ><button id='add' class='btn btn-success' style='margin-left:50% ' >add</button></a>
<input type='button' class='btn btn-secondary' name='btnCancel' value='trở về' onclick='history.back(1)'>
 ";
}

?>



</body>
</html>
