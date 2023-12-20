
    <?php
    session_start();
    unset($_SESSION['user']);
    require('header.php');
    
    
    if (isset($_POST['submit'] )){
    
    require('connection.php');
  
        $user = $_POST['user'];
        $password = md5($_POST['pswd']);
        $sql = "SELECT `IdTaiKhoan`,`TaiKhoan` , `MatKhau`, `Quyen`  FROM NguoiDung WHERE TaiKhoan='$user' AND MatKhau='$password'";
        $result=$conn ->query($sql);
        $row =$result->fetch_assoc();

        $_SESSION['user'] = $user;
        $_SESSION['quyen']= $row['Quyen'];
        $_SESSION['IdTaiKhoan']=$row['IdTaiKhoan'];
        if ($result ->num_rows ==0){
          echo '
          <script>
          
            alert("tên đăng nhập hoặc mật khẩu không đúng bạn vui lòng nhập lại");
            window.location.href = "";
            
          
          
          </script> ';
          
        
    
        }
        if ($row['Quyen']==1){
        echo '
        <script>
        
          alert("bạn đã đăng nhập thành công với tư cách là quản trị viên");
          window.location.href = "index.php";
        
        </script> ';}
        else if ($row['Quyen']==2){
          echo '
          <script>
          
            alert("bạn đã đăng nhập thành công với tư cách là giáo viên");
            window.location.href = "dslop.php";
          
          </script> ';}
        else if ($row['Quyen']==3){
            echo '
            <script>
            
              alert("bạn đã đăng nhập thành công với tư cách là học sinh");
              window.location.href = "txsv.php";
            
            </script> ';}  
        echo '
          <script>
          
            alert("dumamay");
           
            
          
          
          </script> ';

        $conn->close();
      

    };
    ?>
    <center>
<div class="container mt-3" >
  <h2>ĐĂNG NHẬP</h2>
  
  <form action="" method='POST' style="width:40%  ;padding:center ; margin: 0px 0px 100px 0px" >
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
<?php
require('footer.php');?>
</html>