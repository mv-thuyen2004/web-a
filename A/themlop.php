<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
    }
    require('header.php');

    if (isset($_POST['submit'])){
    $MaLop=$_POST['MaLop'];
    $TenLop=$_POST['TenLop'];
    $KhoaHoc=$_POST['KhoaHoc'];
    require('connection.php');
    $sql="INSERT INTO lop (`MaLop`,`TenLop`,`KhoaHoc`) VALUES ('$MaLop','$TenLop',$KhoaHoc)";
    $result= $conn->query($sql);
    echo '
        <script>
        
          alert("bạn đã Thêm Lớp thành công");
          window.location.href = "dslop.php";
        
        </script> ';

}
    ?>
    <div class="container mt-3">
  <h2>nhập thông tin lớp</h2>
  <form action="" method="post">
    <div class="mb-3 mt-3">
      <label for="malop">mã lớp:</label>
      <input type="text" class="form-control" id="malop" placeholder="nhập mã lớp" name="MaLop">
    </div>
    <div class="mb-3">
      <label for="tenlop">tên lớp:</label>
      <input type="text" class="form-control" id="tenlop" placeholder="nhập tên lớp" name="TenLop">
    </div>
    <div class="mb-3">
      <label for="kh">khóa học:</label>
      <input type="number" class="form-control" id="kh" placeholder="nhập khóa học của lớp" name="KhoaHoc">
    </div>
    
    <button type="submit" class="btn btn-primary" name='submit'>thêm lớp</button>
    
  </form>
  <a href='dslop.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>