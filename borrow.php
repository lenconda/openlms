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
    <title>借出</title>
    <?php
        session_start();
        include "config/config_inc.php";
    ?>
</head>
<body>
    <?php
        include "assets/head.php";
    ?>
    <div class="col-md-10">
        <div class="row">
            <div class="panel">
                <div align="center">
                    <form method="post">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $book_info=mysqli_query($link,"select * from `lms_books` where `id`='{$_GET['book_id']}' ");
                            $book_info_row=mysqli_fetch_array($book_info);
                            //计时函数，获取借书时间
                            $borrow_date=date("Y-m-d",time());
                            echo "<h5>".$_GET['book_id']."</h5><br/>";
                            echo "<h5>".$book_info_row['name']."</h5><br/>";
                            echo "<h5>".$book_info_row['type']."</h5><br/>";
                            echo "<h5>".$book_info_row['author']."  著</h5><br/>";
                            echo "<h5>".$book_info_row['publisher']."</h5><br/>";
                            echo "<input type='text' style='width: auto' name='stu_name' class='form-control' placeholder='填写借阅人姓名'><br/>";
                            echo "<input type='text' style='width: auto' name='stu_id' class='form-control' placeholder='填写借阅人身份证号'><br/>";
                            //调用日历作为日期选择器
                            echo "<h5>请选择归还日期</h5><br/>";
                            echo "<input class='form_datetime form-control' type='text' style='width: auto' readonly name='return_time' value='2017-09-07'>";
                            echo "<script type='text/javascript'>$('.form_datetime').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,todayBtn: true,todayHighlight: true,showMeridian: true,pickerPosition: 'bottom-left',startView: 2,minView: 2}); </script>";

                            echo "<br/><div><input type='submit' name='submit' class='btn btn-primary' value='确定'><a href='index.php' class='btn btn-danger'>取消</a></div>";
                            if (isset($_POST['submit'])){
                                $ifexist=mysqli_query($link,"select * from `lms_user` where `name`='{$_POST['stu_name']}' and `id_card`='{$_POST['stu_id']}'");
                                if (mysqli_num_rows($ifexist) != 1) {
                                    echo "<script>alert('未查到此人！请检查借阅者身份信息是否无误')</script>";
                                }elseif ($_POST['return_time'] == ''){
                                    echo "<script>alert('请选择归还日期！')</script>";
                                }else{
                                    $borrow=mysqli_query($link,"INSERT INTO `lms_borrow` (`book_name`, `book_isbn`, `stu_name`, `stu_id`, `borrow_time`, `return_time`, `if_return`) VALUES ('{$book_info_row['name']}', '{$book_info_row['isbn']}', '{$_POST['stu_name']}', '{$_POST['stu_id']}', '{$borrow_date}', '{$_POST['return_time']}', '1')");
                                    if (!$borrow){
                                        echo "<script>alert('借出失败')</script>";
                                    }else{
                                        echo "<script>alert('借出成功')</script>";
                                        echo "<script>window.location.href='index.php'</script>";
                                    }
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
