<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
      <link href="css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
      <link href="css/component.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="css/styles.css" type="text/css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <script src="js/jquery-1.9.1.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/bootstrap-datetimepicker.js"></script>
      <link rel="stylesheet" href="css/main.css" type="text/css"/>
      <title>图书管理系统</title>
      <?php
          include "config/config_inc.php";
          session_start();
          if ($_SESSION['Admin'] == '1'){
              echo "<script>window.location.href='profile/index.php'</script>";
          }elseif ($_SESSION['Admin'] == '0'){

          }else{
              echo "<script>window.location.href='login.php'</script>";
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
                <div class="col-md-10 col-md-offset-2">
                    <div class="page-header">
                        <h1>用户管理</h1>
                    </div>
                        <div class="groupbtn">
                            <button class="btn btn-default" data-toggle="modal" data-target='.myModal1'>添加读者</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target='.myModal2'>添加管理员</button>
                        </div><br/>
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"><a href="#readers" data-toggle="tab">读者</a></li>
                            <li><a href="#admin" data-toggle="tab">管理员</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="readers">
                                <?php
                                mysqli_query($link,"set NAMES 'UTF8'");
                                $read_readers=mysqli_query($link,"select * from `lms_user` where `admin` = '1'");
                                echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                                echo "<tr><th>UID</th><th>姓名</th><th>学号/工号</th><th>身份证号</th><th>操作</th></tr>";
                                while ($read_readers_row=mysqli_fetch_array($read_readers)){
                                    echo "<tr>";
                                    echo "<td>".$read_readers_row['id']."</td>";
                                    echo "<td>".$read_readers_row['name']."</td>";
                                    echo "<td>".$read_readers_row['gen_id']."</td>";
                                    echo "<td>".$read_readers_row['id_card']."</td>";
                                    echo "<td><div><form method='get' action='#'><button name='bl_id' class='btn btn-danger' data-toggle='modal' data-target='.Blacklist' value='{$read_readers_row['id']}'>拉黑</button></form></div></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                ?>
                            </div>
                            <div class="tab-pane fade" id="admin">
                                <?php
                                mysqli_query($link,"set NAMES 'UTF8'");
                                $read_admin=mysqli_query($link,"select * from `lms_user` where `admin` = '0'");
                                echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                                echo "<tr><th>UID</th><th>姓名</th><th>学号/工号</th><th>身份证号</th></tr>";
                                while ($read_admin_row=mysqli_fetch_array($read_admin)){
                                    echo "<tr>";
                                    echo "<td>".$read_admin_row['id']."</td>";
                                    echo "<td>".$read_admin_row['name']."</td>";
                                    echo "<td>".$read_admin_row['gen_id']."</td>";
                                    echo "<td>".$read_admin_row['id_card']."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                ?>
                            </div>
                        </div>
                        <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
                        <script src="js/classie.js"></script>
                        <script src="js/modalEffects.js"></script>
                </div>

            </div>
        </div>
        <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>添加读者</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <input name="stu_name" type="text" style="width: auto" class="form-control" placeholder="请输入姓名"><br/>
                            <input name="gen_id" type="text" style="width: auto" class="form-control" placeholder="请输入学号/工号"><br/>
                            <input name="id_card" type="text" style="width: auto" class="form-control" placeholder="请输入身份证号"><br/>
                            <input name="pw" type="password" style="width: auto" class="form-control" placeholder="请输入密码"><br/>
                            <input name="re_pw" type="password" style="width: auto" class="form-control" placeholder="请再次输入密码"><br/>
                            <div class="modal-footer"><input type="submit" class="btn btn-primary" name="add_reader" value="确定"><button class="btn btn-default" data-dismiss="modal">取消</button></div><!--data-dismiss="modal"点击按钮之后可以关闭窗口-->
                        </form>
                        <?php
                            if (isset($_POST['add_reader'])){
                                if ($_POST['stu_name'] == ''){
                                    echo "<script>alert('未输入姓名')</script>";
                                }elseif ($_POST['gen_id'] == ''){
                                    echo "<script>alert('未输入学号/工号')</script>";
                                }elseif ($_POST['id_card'] == ''){
                                    echo "<script>alert('未输入身份证号')</script>";
                                }elseif ($_POST['pw'] == ''){
                                    echo "<script>alert('未输入密码')</script>";
                                }elseif ($_POST['re_pw'] == ''){
                                    echo "<script>alert('未确认密码')</script>";
                                }elseif ($_POST['pw'] != $_POST['re_pw']){
                                    echo "<script>alert('两次输入密码不相符')</script>";
                                }else{
                                    $add_reader=mysqli_query($link,"INSERT INTO `lms_user` (`id`, `name`, `gen_id`, `id_card`, `password`, `admin`) VALUES (NULL, '{$_POST['stu_name']}', '{$_POST['gen_id']}', '{$_POST['id_card']}', '{$_POST['pw']}', '1')");
                                    if (!$add_reader){
                                        echo "<script>alert('添加读者失败')</script>";
                                    }else{
                                        echo "<script>alert('添加读者成功')</script>";
                                        echo "<script>window.location.href='jump.php?jump=users.php'</script>";
                                    }
                                }
                            }
                        ?>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>


        <div class="modal fade myModal2"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>添加管理员</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <input name="stu_name" type="text" style="width: auto" class="form-control" placeholder="请输入姓名"><br/>
                            <input name="gen_id" type="text" style="width: auto" class="form-control" placeholder="请输入学号/工号"><br/>
                            <input name="id_card" type="text" style="width: auto" class="form-control" placeholder="请输入身份证号"><br/>
                            <input name="pw" type="password" style="width: auto" class="form-control" placeholder="请输入密码"><br/>
                            <input name="re_pw" type="password" style="width: auto" class="form-control" placeholder="请再次输入密码"><br/>
                            <div class="modal-footer"><input type="submit" class="btn btn-primary" name="add_admin" value="确定"><button class="btn btn-default" data-dismiss="modal">取消</button></div><!--data-dismiss="modal"点击按钮之后可以关闭窗口-->
                        </form>
                        <?php
                        if (isset($_POST['add_admin'])){
                            if ($_POST['stu_name'] == ''){
                                echo "<script>alert('未输入姓名')</script>";
                            }elseif ($_POST['gen_id'] == ''){
                                echo "<script>alert('未输入学号/工号')</script>";
                            }elseif ($_POST['id_card'] == ''){
                                echo "<script>alert('未输入身份证号')</script>";
                            }elseif ($_POST['pw'] == ''){
                                echo "<script>alert('未输入密码')</script>";
                            }elseif ($_POST['re_pw'] == ''){
                                echo "<script>alert('未确认密码')</script>";
                            }elseif ($_POST['pw'] != $_POST['re_pw']){
                                echo "<script>alert('两次输入密码不相符')</script>";
                            }else{
                                mysqli_query($link,"set NAMES 'UTF8'");
                                $add_admin=mysqli_query($link,"INSERT INTO `lms_user` (`id`, `name`, `gen_id`, `id_card`, `password`, `admin`) VALUES (NULL, '{$_POST['stu_name']}', '{$_POST['gen_id']}', '{$_POST['id_card']}', '{$_POST['pw']}', '0')");
                                if (!$add_admin){
                                    echo "<script>alert('添加管理员失败')</script>";
                                }else{
                                    echo "<script>alert('添加管理员成功')</script>";
                                    echo "<script>window.location.href='jump.php?jump=users.php'</script>";
                                }
                            }
                        }
                        ?>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>

        <div class="modal fade Blacklist"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $bl_info=mysqli_query($link,"select * from `lms_user` where `id`='{$_GET['bl_id']}'");
                            $bl_info_row=mysqli_fetch_array($bl_info);
                            echo "<h4>确定要将".$bl_info_row['name']."列入黑名单吗</h4>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<h5 style='color: red'>请注意，此操作不可逆！</h5>";
                            echo "<div class='modal-footer'><form method='post'><input type='hidden' value='{$_GET['bl_id']}' name='black_id'><input type='submit' value='确定' name='ok' class='btn btn-danger'><button class='btn btn-default' data-dismiss='modal'>取消</button></form></div>";
                            echo "</div>";
                            if (isset($_POST['ok'])){
                                $blacklist_act=mysqli_query($link,"delete from `lms_user` where `lms_user`.`id`='{$_POST['black_id']}'");
                                if (!$blacklist_act){
                                    echo "<script>alert('加入黑名单失败')</script>";
                                }else{
                                    echo "<script>alert('加入黑名单成功')</script>";
                                    echo "<script>window.location.href='jump.php?jump=users.php'</script>";
                                }
                            }
                        ?>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>

  </body>
  <?php include "assets/footer.php";?>
</html>