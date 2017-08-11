<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
      <link href="../css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
      <link href="../css/component.css" type="text/css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet" type="text/css"/>
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
                    <div class="col-md-10">
                        <div class="page-header">
                            <h1>归还延迟申请</h1>
                        </div>
                        <?php
                        mysqli_query($link,"set NAMES 'UTF8'");
                        $delayed=mysqli_query($link,"select * from `lms_delay` where `applicant_id` = '{$_SESSION['IDCARD']}'");
                        echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                        echo "<tr><th>申请序号</th><th>借阅序号</th><th>书名</th><th>出版商</th><th>迄</th><th>状态</th></tr>";
                        while ($delayed_row=mysqli_fetch_array($delayed)){
                            echo "<tr>";
                            echo "<td>".$delayed_row['id']."</td>";
                            echo "<td>".$delayed_row['book_id']."</td>";
                            echo "<td>".$delayed_row['book_name']."</td>";
                            echo "<td>".$delayed_row['book_publisher']."</td>";
                            echo "<td>".$delayed_row['return_time']."</td>";
                            if ($delayed_row['passed'] == '1'){
                                echo "<td>未批准或被驳回</td>";
                            }elseif ($delayed_row['passed'] == '0'){
                                echo "<td>已批准</td>";
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