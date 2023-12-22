<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa điểm sinh viên</title>
</head>
<body>
<?php
    session_start();
    require 'connection.php';

    require('header.php');
    //Lấy id cần sửa
    $id = $_GET['msv'];
    //kết nối :
  

    //câu lệnh để lấy thông tin về sinh viên:
    $edit_sql= "SELECT * FROM diem INNER JOIN mon ON diem.IdMon=mon.IdMon WHERE MSV=$id AND IdTaiKhoan= ".$_SESSION['IdTaiKhoan']." ";
    $result = mysqli_query($conn,$edit_sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])){
      require_once 'connection.php';//kết nối cơ sở dữ liệu
   
    mysqli_set_charset($conn,'UTF8');
    //nhận dữ liêu từ form:
        $msv = $_POST['MSV'];
        $id = $_POST['IdMon'];
        $diemA = $_POST['DiemA'];
        $diemB = $_POST['DiemB'];
        $diemC = $_POST['DiemC'];
        $ma= $_POST['msv'];
    //viết lệnh sql để sửa dữ liệu :
    $updatesql= "UPDATE diem SET A = '$diemA',B ='$diemB',C='$diemC'WHERE MSV=$ma AND IdMon=$id" ;
    //echo $updatesql;exit;
    //thực thi câu lệnh thêm
    if(mysqli_query($conn,$updatesql)){
        //in thông báo thành công
        //trở về trang liệt kê
    header("Location: txsv.php?MSV=$ma");
    }
    }
  
    
    
?>
 <div class="container mt-3">
  <h2>Nhập thông tin điểm cần sửa</h2>
  <form onsubmit="return kiemTraForm()" action="" method="post">
    <input type="hidden" name ="msv" value ="<?php echo $id;?>">
    <div class="mb-3 mt-3">
      <label for="DiemA">Điểm A:</label>
      
      <input type="number" class="form-control" id="input1" name="DiemA" value ="<?php echo $row['A']?>">
    </div>
    <div class="mb-3">
      <label for="DiemB">Điểm B:</label>
      <input type="number" class="form-control" id="input2" name="DiemB" value ="<?php echo $row['B']?>">
    </div>
    <div class="mb-3">
      <label for="DiemC">Điểm C:</label>
      <input type="number" class="form-control" id="input3" name="DiemC" value ="<?php echo $row['C']?>"><br>
    </div>
    <input type="hidden" id="IdMon" name="IdMon" value="<?php echo $row['IdMon']?>">
    <div>
    <button type="submit" class="btn btn-primary" name='submit'>Cập nhật điểm</button>  
    </div>
    
    
  </form>
  <a href='dssv.php'><button class="btn btn-secondary" >hủy bỏ</button></a>
</body>
</html>