
<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
    require("header.php");
    require('connection.php');
       $IdLop=[];
       $sql="SELECT * FROM lop";
       $result= $conn->query($sql);
       $MSV=$_GET['MSV'];
       $rows=0;
       while($row=$result->fetch_assoc()) //doc tung dong cua ket qua
            {
                if (!(in_array($row['IdLop'],$IdLop))){
                    $IdLop[$rows][0]= $row['IdLop'];
                    $IdLop[$rows][1]= $row['MaLop'];
                    $rows++;
                }
            }    
        $conn->close();
        if(isset($_GET['submit'])){
          
          require('connection.php');
          $sql="UPDATE `thongtinsinhvien` SET `Ten`='".$_GET['ten']."',`IdLop`='".$_GET['IdLop']."' WHERE `MSV`=".$_GET['MSV'] ;
          $result= $conn->query($sql);
          $conn->close();
          echo '
        <script>
        
          alert("bạn đã Sửa Thông Tin Học Sinh thành công");
          window.location.href = "dssv.php";
        
        </script> ';
        }
      
    ?>

    <div class="container mt-3">
  <h2>nhập thông tin học sinh</h2>
  <form action="" method="get">
    <div class="mb-3 mt-3">
      <label for="ten">tên sinh viên:</label>
      <input type="text" class="form-control" id="ten" placeholder="nhập tên sinh viên" name="ten" value=>
    </div>
    <label for="malop">chọn lớp:</label>
      <select class="form-select" id="malop" name='IdLop'>
        <?php 
        foreach ($IdLop as $value) {
            echo "<option value=".$value[0].">".$value[1]."</option>";
          };
        ?>
      </select>
      <input type="hidden" id="custId" name="MSV" value="<?php echo $MSV ?>">
    
    <button type="submit" class="btn btn-primary" name="submit">sửa thông tin học sinh</button>
  </form>
  <a href='dssv.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</div>
</body>
<?php
require('footer.php');?>
</html>
   