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
    padding: 56px;
    font-size: 84px;
    color: #0000ff;
    text-shadow: 2px 2px #66ccff;
    text-align: center;
    text-transform:  uppercase;
}
body{
	background-color: #d9f1f4;
}

    </style>
</head>
<body>
    <header>
    <div class="header">Thông Tin Sinh Viên</div>
    <?php
    session_start();
    if(isset($_SESSION['user'])): ?>
			<a href="login.php" style="text-decoration: none; float: right;"><button class="btn btn-danger">log out</button></a>
		<?php endif; ?>
    </header>
    
</body>
</html>