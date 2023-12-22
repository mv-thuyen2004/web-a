<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

    require 'connection.php';
    require('header.php');

    //xử lý xóa học sinh
    if (isset($_GET['idxoa'])){
    $ys=$_GET['idxoa'];
    $sql="DELETE FROM thongtinsinhvien WHERE `MSV` = $ys ";
    $result= $conn->query($sql);
    echo '
        <script>
          alert("bạn xóa sinh viên thành công ");
        </script> '; 
    }

    // lấy tên các lớp
    $IdLop=[];
    $sql="SELECT * FROM lop";
    $result= $conn->query($sql);
    $rows=0;
    while($row=$result->fetch_assoc()) 
        {
          if (!(in_array($row['IdLop'],$IdLop))){
              $IdLop[$rows][0]= $row['IdLop'];
              $IdLop[$rows][1]= $row['MaLop'];
              $rows++;
              }
        }    
    // xử lý để in thông tin của học sinh cần tìm kiếm khi đăng nhập bằng chức vụ admin
    mysqli_set_charset($conn,'UTF8');
    if ($_SESSION['quyen']==1  ){
      
    $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop ";
    $result= $conn->query($sql);
       if ( !($_GET['msv']=="") & isset($_GET['IdLop']) ) {
        $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE `MSV` = ".$_GET['msv'];
        $result= $conn->query($sql);
      }
      else if (!($_GET['msv']=="")){
        $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE `MSV` = ".$_GET['msv'];
        $result= $conn->query($sql);
      }
      else if (isset($_GET['IdLop'])){
        $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE lop.`IdLop` = ".$_GET['IdLop'];
        $result= $conn->query($sql);
      }
      else {
        $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop ";
        $result= $conn->query($sql);
      }

    
    }


    // xử lý để in thông tin học khi đăng nhập với quyền là giáo viên
    else if ($_SESSION['quyen']==2){
    $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE lop.MaLop='".$_GET['malop']."'";
    $result= $conn->query($sql);
     if (!($_GET['msv']=="")){
      $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop WHERE `MSV` = ".$_GET['msv'];
      $result= $conn->query($sql);
     }
     else {
      $sql="SELECT `MSV` , `Ten`,`TenLop` FROM thongtinsinhvien INNER JOIN lop ON lop.IdLop=thongtinsinhvien.IdLop ";
      $result= $conn->query($sql);
    }}
?>

<!-- thanh tìm kiếm -->
<div class="container mt-3">
<form method="get" action="">
    <div class="row">
      <div class="col">
        <input type="text" class="form-control" placeholder="mã sinh viên" name="msv">
      </div>
      <?php
      if ($_SESSION['quyen']==1  ){
      echo "
      <div class='col'>
      <select class='form-select' id='malop' name='IdLop'>
        <option selected disabled>chọn lớp</option>";
        foreach ($IdLop as $value) {
            echo "<option value=".$value[0].">".$value[1]."</option>";
          };
      echo "
      </select>
      </div>";}
      ?>
      <div class="col">
      <button type="submit" class="btn btn-primary" name='submit'>tìm kiếm</button>
      </div>
    </div>
  </form>

<!-- in ra danh sách sinh viên-->
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
              echo "<td><a href='suasinhvien.php?MSV=".$row['MSV']."' style='text-decoration:none; color:green ;padding-left: 25px;' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
              <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
              <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
            </svg>    </a><a  href='dssv.php?idxoa=".$row['MSV']. "'style='text-decoration:none;color:red'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-person-x' viewBox='0 0 16 16'>
              <path d='M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z'/>
              <path d='M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708'/>
            </svg></a></td>";
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
// khi đăng nhập bằng những quyền khác nhau thì sẽ hiện ra những nút có chức năng khác nhau
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
