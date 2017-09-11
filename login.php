<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>图书馆统一登录系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"; charset="utf-8">
    <link href="bootstrap/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="css/main.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <!--<script type="text/javascript" src="placeholder.js"></script>-->
    <?php
    include("config/config_inc.php");
    if (!$link){
        echo"<script>alert('连接数据库时发生错误！')</script>";
    }else{
        if (isset($_POST['submit'])) {
            mysqli_query($link, "set NAMES 'UTF8'");
            $result = mysqli_query($link, "select * from `lms_user` where `id_card` = '{$_POST['name']}' and `password` = '{$_POST['pw']}'");
            if (mysqli_num_rows($result) == 1) {
                $identity=mysqli_query($link,"select * from `lms_user` where `id_card`='{$_POST['name']}'");
                $identity_row=mysqli_fetch_array($identity);
                if ($identity_row['admin'] == '0'){
                    session_start();
                    $_SESSION['Admin']='0';//判断身份
                    $_SESSION['UID']=$identity_row['id'];//设置一个全局变量存储用户ID
                    $_SESSION['IDCARD']=$identity_row['id_card'];
                    $_SESSION['NAME']=$identity_row['name'];
                    echo "<script>window.location.href='index.php'</script>";//跳转到管理员界面
                }else{
                    session_start();
                    $_SESSION['Admin']='1';//判断身份
                    $_SESSION['UID']=$identity_row['id'];//设置一个全局变量存储用户ID
                    $_SESSION['IDCARD']=$identity_row['id_card'];
                    $_SESSION['NAME']=$identity_row['name'];
                    echo "<script>window.location.href='profile/index.php'</script>";//跳转到用户界面
                }
            }else{
                echo "<script>alert('身份证号或密码错误！');</script>";
            }
        }
    }
    ?>

</head>

<body>
<br/><br/><h3 align="center">登录::图书馆统一登录</h3><br/>
<br/><div align="center" class="panel-body">
    <form id="slick-login" method="post">
        <input type="text" style="width: auto" name="name" class="form-control" placeholder="身份证号"><br/>
        <input type="password" name="pw" style="width: auto" class="form-control" placeholder="密码">
        <br/>
        <input type="submit" name="submit" class="btn btn-primary" value="登录">
        <br/>
    </form>
</div>
</body>
</html>