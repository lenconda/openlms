<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link href="css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
    <link href="css/component.css" type="text/css" rel="stylesheet">
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
        include "assets/sidebar.php";
    ?>
    <div class="col-md-10">
        <div class="row">
            <div align="center"><h3>延迟归还申请</h3></div>
            <?php
                include "config/config_inc.php";
                mysqli_query($link,"set NAMES 'UTF8'");
                $delayed=mysqli_query($link,"select * from `lms_delay` order by `passed`");
                echo "<br/><table class='table'>";     //使用表格格式化数据
                echo "<tr><th>申请序号</th><th>图书名称</th><th>出版商</th><th>申请人姓名</th><th>身份证号</th><th>借阅时间</th><th>延迟到</th><th>操作</th></tr>";
                while ($delayed_row=mysqli_fetch_array($delayed)){
                    echo "<tr>";
                    echo "<td>".$delayed_row['id']."</td>";
                    echo "<td>".$delayed_row['book_name']."</td>";
                    echo "<td>".$delayed_row['book_publisher']."</td>";
                    echo "<td>".$delayed_row['applicant_name']."</td>";
                    echo "<td>".$delayed_row['applicant_id']."</td>";
                    echo "<td>".$delayed_row['return_time']."</td>";
                    echo "<td><div><form method='get' action='#'><button name='rl_book_id' class='btn btn-primary' data-toggle='modal' data-target='.myModal1' value='{$delayed_row['id']}'>批准</button></form></div></td>";
                    echo "</tr>";
                }
            ?>
            <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
            <script src="js/classie.js"></script>
            <script src="js/modalEffects.js"></script>
        </div>
    </div>
    <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>确认批准这个延迟申请吗</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <?php
                        $approve=mysqli_query($link,"select * from `lms_relay` where `id`='{$_GET['rl_book_id']}'");
                        $approve_row=mysqli_fetch_array($approve);
                        echo "<h5 align='center' style='color: red'>请注意，此操作不可逆！</h5>";
                        echo "<div><form method='post'><input type='hidden' name='approve_id' value='{$approve_row['id']}'><input type='submit' class='btn btn-danger' name='approval' value='确定'></form><button class='btn btn-primary' data-dismiss='modal'>取消</button></div>";
                        if (isset($_POST['approval'])){
                            $approve_act_borrow=mysqli_query($link,"update `lms_borrow` set `return_time`='{$approve_row['return_time']}' where `id`={$_POST['approve_id']}");
                            $approve_act_delay=mysqli_query($link,"update `lms_delay` set `passed`='0' where `id`={$_POST['approve_id']}");
                            if (!$approve_act_borrow or !$approve_act_delay){
                                echo "<script>alert('操作失败')</script>";
                            }else{
                                echo "<script>alert('操作成功')</script>";
                                echo "<script>window.location.href='jump.php?jump=delay.php'</script>";
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