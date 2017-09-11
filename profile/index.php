<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
      <link href="../css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
      <link href="../css/component.css" type="text/css" rel="stylesheet">
      <link href="../css/main.css" rel="stylesheet" type="text/css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <script src="../js/jquery-1.9.1.js"></script>
      <script src="../js/bootstrap.js"></script>
      <script src="../js/bootstrap-datetimepicker.js"></script>
      <title>个人中心</title>
      <?php
          include "../config/config_inc.php";
          session_start();
          if ($_SESSION['Admin'] == '1'){

          }elseif ($_SESSION['Admin'] == '0'){
              echo "<script>window.location.href='../index.php'</script>";
          }else{
              echo "<script>window.location.href='../login.php'</script>";
          }
      ?>
  </head>
  <body>
        <?php
            include "assets/head.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                    include "assets/sidebar.php";
                ?>
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="page-header">
                            <h1>个人资料</h1>
                        </div>
                        <div class="groupbtn">
                            <?php echo"<form method='get' action='#'><button name='updateinfo' class='btn btn-default' data-toggle='modal' data-target='.myModal1' value='{$_SESSION['UID']}'>修改信息</button>&nbsp;<button name='updatepw' class='btn btn-warning' data-toggle='modal' data-target='.myModal1_pw' value='{$profile_row['id']}'>修改密码</button></form>"?>
                        </div>
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $profile=mysqli_query($link,"select * from `lms_user` where `id` = '{$_SESSION['UID']}'");
                            $profile_row=mysqli_fetch_array($profile);
                            echo "<h5>用户ID：".$profile_row['id']."</h5><br/>";
                            echo "<h5>姓名：".$profile_row['name']."</h5><br/>";
                            echo "<h5>学号/工号：".$profile_row['gen_id']."</h5><br/>";
                            echo "<h5>身份证号：".$profile_row['id_card']."</h5><br/>";
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>修改信息</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                                $update_act=mysqli_query($link,"select * from `lms_user` where `id`='{$_GET['updateinfo']}'");
                                $update_act_row=mysqli_fetch_array($update_act);
                                echo "<label for='stu_name'>姓名</label>";
                                echo "<input name='stu_name' id='stu_name' class='form-control' type='text' style='width: auto' value='{$update_act_row['name']}'><br/>";
                                echo "<label for='gen_id'>学号/工号</label>";
                                echo "<input name='gen_id' id='gen_id' class='form-control' type='text' style='width: auto' value='{$update_act_row['gen_id']}'><br/>";
                                echo "<label for='id_card'>身份证号</label>";
                                echo "<input name='id_card' id='id_card' class='form-control' type='text' style='width: auto' value='{$update_act_row['id_card']}'><br/>";
                                echo "<div class='modal-footer'><input type='hidden' name='update_id' value='{$_GET['updateinfo']}'><input type='submit' name='submit' value='确定' class='btn btn-primary'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                                if (isset($_POST['submit'])){
                                    if ($_POST['stu_name'] == ''){
                                        echo "<script>alert('未填写姓名')</script>";
                                    }elseif($_POST['gen_id'] == ''){
                                        echo "<script>alert('未填写学号/工号')</script>";
                                    }elseif($_POST['id_card'] == ''){
                                        echo "<script>alert('未填写姓名')</script>";
                                    }else{
                                        $modify=mysqli_query($link,"UPDATE `lms_user` SET `name`='{$_POST['stu_name']}', `id_card` = '{$_POST['id_card']}', `gen_id` = '{$_POST['gen_id']}' WHERE `lms_user`.`id` = '{$_POST['update_id']}'");
                                        if (!$modify){
                                            echo "<script>alert('修改失败')</script>";
                                        }else{
                                            echo "<script>alert('修改成功')</script>";
                                            $_SESSION['NAME']=$_POST['stu_name'];
                                            $_SESSION['IDCARD']=$_POST['id_card'];
                                            echo "<script>window.location.href='../jump.php?jump=profile/index.php'</script>";
                                        }
                                    }
                                }
                            ?>
                        </form>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>

        <div class="modal fade myModal1_pw"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>修改密码</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                            $modpw_act=mysqli_query($link,"select * from `lms_user` where `id`='{$_GET['updatepw']}'");
                            $modpw_act_row=mysqli_fetch_array($modpw_act);
                            echo "<input name='oldpw' class='form-control' type='password' style='width: auto' placeholder='输入原密码'><br/>";
                            echo "<input name='newpw' class='form-control' type='password' style='width: auto' placeholder='输入新密码'><br/>";
                            echo "<input name='confirm' class='form-control' type='password' style='width: auto' placeholder='确认新密码'><br/>";
                            echo "<div class='modal-footer'><input type='hidden' name='modpw_id' value='{$_GET['updatepw']}'><input type='submit' name='modpw' value='确定' class='btn btn-primary'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                            if (isset($_POST['modpw'])){
                                if ($_POST['oldpw'] == ''){
                                    echo "<script>alert('未输入原密码')</script>";
                                }elseif($_POST['oldpw'] != $modpw_act_row['password']){
                                    echo "<script>alert('原密码输入错误')</script>";
                                }elseif($_POST['newpw'] == ''){
                                    echo "<script>alert('未输入新密码')</script>";
                                }elseif ($_POST['confirm'] == ''){
                                    echo "<script>alert('未确认新密码')</script>";
                                }elseif($_POST['newpw'] != $_POST['confirm']){
                                    echo "<script>alert('两次输入密码不一致')</script>";
                                }else{
                                    $modpw=mysqli_query($link,"UPDATE `lms_user` SET `password`='{$_POST['newpw']}' WHERE `lms_user`.`id` = '{$_POST['modpw_id']}'");
                                    if (!$modpw){
                                        echo "<script>alert('修改密码失败')</script>";
                                    }else{
                                        echo "<script>alert('修改密码成功')</script>";
                                        echo "<script>window.location.href='../logout.php?action=logout'</script>";
                                    }
                                }
                            }
                            ?>
                        </form>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>

  </body>
</html>