<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	
    <title>Document</title>
    
        <style>
        *{margin: 0; padding: 0;}
header .header{
	background-color: antiquewhite;
    padding : 1%;
    font-size: 50px;
    color: #0000ff;
    text-shadow: 2px 2px #66ccff;
    text-align: center;
    text-transform:  uppercase;
}
body{
	background-color: #d9f1f4;
}

    </style>
<!--kiểm tra các dữ liệu các form xem đã có chưa trước khi gửi lên-->
<script>
function kiemTraForm() {
    var inputs = document.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type === 'text' && inputs[i].value.trim() === '') {
            alert('Vui lòng điền đầy đủ thông tin.');
            return false; // Ngăn chặn việc submit nếu có input chưa nhập
        }
    }
    // Nếu đã kiểm tra hết và không có input nào chưa nhập, cho phép submit
    return true;
}
</script>
</head>
<body>
    <header>
    <div class="header">
        <p>HANOI UNIVERSITY OF MINING OF GEOLOGY</p> 
    <img src="2.png" alt="" style="height: 10%; width:10%"></div>
    <marquee>TRƯỜNG ĐẠI HỌC ĐA NGÀNH HÀNG ĐẦU VIỆT NAM, THUỘC NHÓM 95 TRƯỜNG ĐẠI HỌC HÀNG ĐẦU ĐÔNG NAM Á</marquee>

    
    <?php
    session_start();
    if(isset($_SESSION['user'])): ?>
			<a href="login.php" style="text-decoration: none; float: right;"><button class="btn btn-danger">log out</button></a>
		<?php endif; ?>
    
    </header>
