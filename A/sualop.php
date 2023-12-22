<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

require 'connection.php';
require('header.php');
mysqli_set_charset($conn,'UTF8');
//select để in ra thông tin của lớp muốn sửa
if (isset($_GET['malop'])){
    $_SESSION['MaLop']=$_GET['malop'];
    $sql="SELECT * FROM lop WHERE `MaLop` = '".$_SESSION['MaLop']."' ";
    $result= $conn->query($sql);
    $row1=$result->fetch_assoc();   
}
// cập nhật thông tin lớp sau khi đã cập nhật
if (isset($_GET['submit'])){
    $sql="UPDATE lop SET `MaLop`='".$_GET['MaLop']."',`TenLop`='".$_GET['TenLop']."',`KhoaHoc`=".$_GET['KhoaHoc']." WHERE `MaLop` = '".$_SESSION['MaLop']."' ";
    $result1= $conn->query($sql);
    echo '
        <script>
          alert("bạn đã sửa Lớp thành công");
          window.location.href = "dslop.php";
        </script> ';
}
    
?>
 <div class="container mt-3">
  <h2>nhập thông tin lớp</h2>
  <form onsubmit="return kiemTraForm()" action="" method="GET">
    <div class="mb-3 mt-3">
      <label for="malop">mã lớp:</label>
      <?php echo '
      <input type="text" class="form-control" id="input1" placeholder="'.$row1["MaLop"].'" value="'.$row1["MaLop"].'" name="MaLop"> ';?>
    </div>
    <div class="mb-3">
      <label for="tenlop">tên lớp:</label>
      <?php echo '
      <input type="text" class="form-control" id="input2" placeholder="'.$row1["TenLop"].'" value="'.$row1["TenLop"].'" name="TenLop"> ';?>
    </div>
    <div class="mb-3">
      <label for="kh">khóa học:</label>
      <?php echo '
      <input type="number" class="form-control" id="input3" placeholder="'.$row1["KhoaHoc"].'"  name="KhoaHoc"> ';?>
    </div>
    
    <button type="submit" class="btn btn-primary" name='submit'>sửa</button>
    
  </form>
  <a href='dslop.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>