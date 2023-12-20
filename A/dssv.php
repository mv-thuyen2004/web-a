

<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
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
    if ($_SESSION['quyen']==1){
    $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop ";
    $result= $conn->query($sql);
    }
    else if ($_SESSION['quyen']==2){
    $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE lop.MaLop='".$_GET['malop']."'";
    $result= $conn->query($sql);
    }
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
            
        
            if ($_SESSION['quyen']==1){
              echo "<td><a href='suasinhvien.php?MSV=".$row['MSV']."' style='text-decoration:none; color:green' >sửa    </a><a  href='dssv.php?idxoa=".$row['MSV']. "'style='text-decoration:none;color:red'>xóa</a></td>";
              }
            else if ($_SESSION['quyen']==2){

                echo "<td><a  href='suadiem.php?msv=".$row['MSV']. "'style='text-decoration:none;color:green'>sửa điểm</a></td>";

              }


        }
    }
    else{
        echo ' bạn không dạy học sinh nào trong lớp này';
    }
    
    $conn->close();
?>
    </tbody>
  </table>
</div>
<?php
if ($_SESSION['quyen']==1){
  echo "
<a href='themsinhvien.php?' ><button id='add' class='btn btn-success' style='margin-left:50% ' >thêm học sinh</button></a>
<a href='index.php'><button class='btn btn-secondary' style='float:right '>trở về</button></a> ";
}
else if ($_SESSION['quyen']==2){
  echo "<a href='dslop.php'><button class='btn btn-secondary' style='float:right '>trở về</button></a>";
}
?>





</body>
<?php
require('footer.php');?>
</html>
