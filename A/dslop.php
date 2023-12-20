
<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
    require 'connection.php';
    require('header.php');
    mysqli_set_charset($conn,'UTF8');
    if (isset($_GET['idxoa'])){
        $idxoa=$_GET['idxoa'];
        $sql1="DELETE FROM thongtinsinhvien WHERE `IdLop` = '$idxoa' ";
        $sql2="DELETE FROM lop WHERE `IdLop` = '$idxoa' ";

        $result1= $conn->query($sql1);
        $result2=$conn->query($sql2);
        echo '
            <script>
              alert("bạn xóa lớp thành công ");
            </script> '; 
        }
    $sql="SELECT `IdLop` , `MaLop` , `TenLop`,`KhoaHoc` FROM lop  ";
    $result= $conn->query($sql);
?>


<div class="container mt-3">
  <h2>Danh Sách Lớp</h2>
              
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
            echo "<td><a href='sualop.php?malop=".$row['MaLop']."' style='text-decoration:none; color:green' >sửa   </a><a href='dslop.php?idxoa=".$row['IdLop']. "' style='text-decoration:none;color:red'>xóa</a></td>";
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
<a href='themlop.php' ><button id='add' class='btn btn-success' style='margin-left:50% ' >thêm lớp</button></a>
<a href='index.php'><button class='btn btn-secondary' style='float:right '>trở về</button></a>
 ";
}

?>



</body>
<?php
require('footer.php');?>
</html>
