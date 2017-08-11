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
                            <h1>归还记录</h1>
                        </div>
                        <?php
                        mysqli_query($link,"set NAMES 'UTF8'");
                        $returned=mysqli_query($link,"select * from `lms_borrow` where `stu_id` = '{$_SESSION['IDCARD']}' and `if_return` = '0' or `if_return` = '2' ");
                        echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                        echo "<tr><th>借阅单号</th><th>书名</th><th>出版商</th><th>ISBN</th><th>借出日期</th><th>归还日期</th><th>状态</th></tr>";
                        while ($returned_row=mysqli_fetch_array($returned)){
                            echo "<tr>";
                            echo "<td>".$returned_row['id']."</td>";
                            echo "<td>".$returned_row['book_name']."</td>";
                            echo "<td>".$returned_row['book_publisher']."</td>";
                            echo "<td>".$returned_row['book_isbn']."</td>";
                            echo "<td>".$returned_row['borrow_time']."</td>";
                            echo "<td>".$returned_row['return_time']."</td>";
                            if ($returned_row['if_return'] == '0'){
                                echo "<td>已归还</td>";
                            }elseif ($returned_row){
                                echo "<td>已归还(逾期)</td>";
                            }else{
                                echo "<td>查询失败</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>

            </div>
        </div>
  </body>
  <?php include "../assets/footer.php";?>
</html>