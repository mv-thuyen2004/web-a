
<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

    require 'connection.php';
    require('header.php');
    mysqli_set_charset($conn,'UTF8');
    // xử lý khi xóa lớp thì nó sẽ xóa lớp và tất cả sinh viên của lớp đó
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
    // truy xuất thông tin các lớp
    $sql="SELECT `IdLop` , `MaLop` , `TenLop`,`KhoaHoc` FROM lop  ";
    $result= $conn->query($sql);
?>

<!-- in ra thông tin lớp học-->
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
            // nếu đăng nhập bằng admin sẽ có chức năng sửa lớp và xóa lớp
            if($_SESSION['quyen']==1){
            echo "<td><a href='sualop.php?malop=".$row['MaLop']."' style='text-decoration:none; color:green;padding-left:20px' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
          </svg>    </a>   </a><a href='dslop.php?idxoa=".$row['IdLop']. "' style='text-decoration:none;color:red'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
          <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
          <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
        </svg></a></td>";
            }
            else if ($_SESSION['quyen']==2){
              echo "<td><a href='dssv.php?malop=".$row['MaLop']. "' style='text-decoration:none;color:red'>danh sách sinh viên</a></td>";
            
            
            }
        


        }
    }
    else{
        echo 'không có lớp nào trong cơ sở dữ liệu';
    }
    
    $conn->close();
?>
    </tbody>
  </table>
</div>
<?php
// khi đăng nhập bằng admin sẽ thêm chức năng thêm lớp
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
