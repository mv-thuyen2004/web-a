<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
require 'connection.php';
require('header.php');
mysqli_set_charset($conn,'UTF8');
if (isset($_GET['malop'])){
    $_SESSION['MaLop']=$_GET['malop'];
    $sql="SELECT * FROM lop WHERE `MaLop` = '".$_SESSION['MaLop']."' ";
    $result= $conn->query($sql);
    $row1=$result->fetch_assoc();

    
}
if (isset($_GET['submit'])){
    $sql="UPDATE lop SET `MaLop`='".$_GET['MaLop']."',`TenLop`='".$_GET['TenLop']."',`KhoaHoc`=".$_GET['KhoaHoc']." WHERE `MaLop` = '".$_SESSION['MaLop']."' ";
    $result1= $conn->query($sql);
    
    echo '
        <script>
        
          alert("bạn đã sửa Lớp thành công");
          window.location.href = "dslop.php";
        
        </script> ';
}
    


echo 'trang này sẽ sớm được hoàn thành';
?>
 <div class="container mt-3">
  <h2>nhập thông tin lớp</h2>
  <form action="" method="GET">
    <div class="mb-3 mt-3">
      <label for="malop">mã lớp:</label>
      <?php echo '
      <input type="text" class="form-control" id="malop" placeholder="'.$row1["MaLop"].'" value="'.$row1["MaLop"].'" name="MaLop"> ';?>
    </div>
    <div class="mb-3">
      <label for="tenlop">tên lớp:</label>
      <?php echo '
      <input type="text" class="form-control" id="tenlop" placeholder="'.$row1["TenLop"].'" value="'.$row1["TenLop"].'" name="TenLop"> ';?>
    </div>
    <div class="mb-3">
      <label for="kh">khóa học:</label>
      <?php echo '
      <input type="number" class="form-control" id="kh" placeholder="'.$row1["KhoaHoc"].'" value="'.$row1["KhoaHoc"].'" name="KhoaHoc"> ';?>
    </div>
    
    <button type="submit" class="btn btn-primary" name='submit'>sửa</button>
    
  </form>
  <a href='dslop.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>