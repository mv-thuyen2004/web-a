
    <?php
    session_start();
    require("header.php");
    if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
    }
    require('connection.php');

       // select để thêm các lớp vào biến để chọn khi thêm sinh viên
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
        $conn->close();

        // xử lý thêm sinh viên
        if(isset($_GET['submit'])){
          
          require('connection.php');
          $sql="INSERT INTO `thongtinsinhvien`( `Ten`, `IdLop`) VALUES ('".$_GET['ten']."','".$_GET['IdLop']."')";
          $result= $conn->query($sql);
          $conn->close();
          echo '
        <script>
        
          alert("bạn đã Thêm Học Sinh thành công");
          window.location.href = "dssv.php";
        
        </script> ';
        }
      
    ?>

    <div class="container mt-3">
  <h2>nhập thông tin học sinh</h2>
  <form onsubmit="return kiemTraForm()" action="" method="get">
    <div class="mb-3 mt-3">
      <label for="ten">tên sinh viên:</label>
      <input type="text" class="form-control" id="input1" placeholder="nhập tên sinh viên" name="ten">
    </div>
    <label for="malop">chọn lớp:</label>
      <select class="form-select" id="input2" name='IdLop'>
        <?php 
        foreach ($IdLop as $value) {
            echo "<option value=".$value[0].">".$value[1]."</option>";
          };
        ?>
      </select>
    
    <button type="submit" class="btn btn-primary" name="submit">Thêm học sinh</button>
  </form>
  <a href='dssv.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>