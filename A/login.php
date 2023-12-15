<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    
</head>
<body>
    <?php
    session_start();
    unset($_SESSION['user']);
    require('header.php');
    
    
    if (isset($_POST['submit'] )){
    
    require('connection.php');
  
        $user = $_POST['user'];
        $password = md5($_POST['pswd']);
        $sql = "SELECT `TaiKhoan` , `MatKhau`  FROM NguoiDung WHERE TaiKhoan='$user' AND MatKhau='$password'";
        $result=$conn ->query($sql);
        $row =$result->fetch_assoc();
        $_SESSION['user'] = $user;
        if ($result ->num_rows ==0){
          echo '
          <script>
          
            alert("tên đăng nhập hoặc mật khẩu không đúng bạn vui lòng nhập lại");
            window.location.href = "";
            
          
          
          </script> ';
          
        
    
        }
        
        echo '
        <script>
        
          alert("bạn đã đăng nhập thành công");
          window.location.href = "index.php";
        
        </script> ';

        $conn->close();
      

    };
    ?>
    <center>
<div class="container mt-3" >
  <h2>ĐĂNG NHẬP</h2>
  
  <form action="" method='POST' style="width:40% ;padding:center" >
    <div class="mb-3 mt-3">
      <label for="user">User:</label>
      <input type="text" class="form-control" id="user" placeholder="Enter user" name="user">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
    </div>
    
    <button type="submit" name ="submit" class="btn btn-primary">ĐĂNG NHẬP</button>
  </form>
  
</div>
</center>
</body>
</html>