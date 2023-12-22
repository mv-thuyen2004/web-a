
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
    }
    // xử lý thêm lớp khi ta ấn nút submit
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
  <form onsubmit="return kiemTraForm()" action="" method="post">
    <div class="mb-3 mt-3">
      <label for="malop">mã lớp:</label>
      <input type="text" class="form-control" id="input1" placeholder="nhập mã lớp" name="MaLop">
    </div>
    <div class="mb-3">
      <label for="tenlop">tên lớp:</label>
      <input type="text" class="form-control" id="input2" placeholder="nhập tên lớp" name="TenLop">
    </div>
    <div class="mb-3">
      <label for="kh">khóa học:</label>
      <input type="number" class="form-control" id="input3" placeholder="nhập khóa học của lớp" name="KhoaHoc">
    </div>
    
    <button type="submit" class="btn btn-primary" name='submit'>thêm lớp</button>
    
  </form>
  <a href='dslop.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>