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
    <link type="text/css" href="css/main.css" rel="stylesheet">
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
                    <h1>图书归还</h1>
                </div>
                    <?php
                        include "config/config_inc.php";
                        mysqli_query($link,"set NAMES 'UTF8'");
                        $books=mysqli_query($link,"select * from `lms_borrow` where `if_return`='1'");
                        echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                        echo "<tr><th>借阅序号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅人姓名</th><th>身份证号</th><th>借阅时间</th><th>归还时间</th><th>操作</th></tr>";
                        while ($books_return=mysqli_fetch_array($books)){
                            echo "<tr>";
                            echo "<td>".$books_return['id']."</td>";
                            echo "<td>".$books_return['book_name']."</td>";
                            echo "<td>".$books_return['book_isbn']."</td>";
                            echo "<td>".$books_return['book_publisher']."</td>";
                            echo "<td>".$books_return['stu_name']."</td>";
                            echo "<td>".$books_return['stu_id']."</td>";
                            echo "<td>".$books_return['borrow_time']."</td>";
                            echo "<td>".$books_return['return_time']."</td>";
                            //echo "<td>".$books_borrowed['intime']."</td>";
                            //echo "<td>".$books_borrowed['borrow']."</td>";
                            echo "<td><div><form method='get' action='#'><button name='rt_book_id' class='btn btn-primary' data-toggle='modal' data-target='.myModal1' value='{$books_return['id']}'>归还</button></form></div></td>";
                            echo "</tr>";
                        }
                    ?>
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
                    <h4>确认将这本书的状态变为归还吗</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <?php
                        $return=mysqli_query($link,"select * from `lms_borrow` where `id`='{$_GET['rt_book_id']}'");
                        $return_row=mysqli_fetch_array($return);
                        echo "<h5>借阅序号：".$return_row['id']."</h5>";
                        echo "<h5>图书名称：".$return_row['book_name']."</h5>";
                        echo "<h5>出版商：  ".$return_row['book_publisher']."</h5>";
                        echo "<h5>借阅人：  ".$return_row['stu_name']."</h5><br/>";
                        echo "<div><form method='post'><select class='form-control' style='width: auto' name='status'><option value='0'>按时归还</option><option value='2'>逾期归还</option></select><input type='hidden' name='borrow_id' value='{$return_row['id']}'><br/><div class='modal-footer' ><input type='submit' class='btn btn-primary' name='return' value='确定'></form><button class='btn btn-default' data-dismiss='modal'>取消</button></div></div>";
                        if (isset($_POST['return'])){
                            $today=date("Y-m-d",time());
                            $return_act=mysqli_query($link,"update `lms_borrow` set `if_return`='{$_POST['status']}',`return_time`='{$today}' where `id`={$_POST['borrow_id']}");
                            if (!$return_act){
                                echo "<script>alert('还书失败')</script>";
                            }else{
                                echo "<script>alert('还书成功')</script>";
                                echo "<script>window.location.href='jump.php?jump=return.php'</script>";
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