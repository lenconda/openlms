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
        <title>查询结果</title>
        <?php
            include "config/config_inc.php";
            session_start();
        ?>
    </head>
    <body>
        <div class="col-md-10" align="center">
            <div class="row" align="center">
                <div align="center"><h3>查询结果</h3></div>
                <?php
                    include "config/config_inc.php";
                    session_start();
                    mysqli_query($link,"set NAMES 'UTF8'");
                    if ($_GET['forward'] == '0') {
                        if ($_GET['search'] == 'books') {
                            $books = mysqli_query($link, "select * from `lms_books` where `name` like '%{$_GET['object']}%' order by `borrow` desc");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>ID</th><th>名称</th><th>类型</th><th>作者</th><th>ISBN</th><th>出版商</th><th>价格</th><th>页数</th><th>入库时间</th><th>借阅次数</th><th>操作</th></tr>";
                            while ($books_row = mysqli_fetch_array($books)) {
                                echo "<tr>";
                                echo "<td>" . $books_row['id'] . "</td>";
                                echo "<td>" . $books_row['name'] . "</td>";
                                echo "<td>" . $books_row['type'] . "</td>";
                                echo "<td>" . $books_row['author'] . "</td>";
                                echo "<td>" . $books_row['isbn'] . "</td>";
                                echo "<td>" . $books_row['publisher'] . "</td>";
                                echo "<td>" . $books_row['price'] . "</td>";
                                echo "<td>" . $books_row['page'] . "</td>";
                                echo "<td>" . $books_row['intime'] . "</td>";
                                echo "<td>" . $books_row['borrow'] . "</td>";
                                echo "<td><div><form method='get' action='index.php'><button name='br_book_id' class='btn btn-primary' data-toggle='modal' data-target='.myModal1' value='{$books_row['id']}'>借出</button></form></div></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } elseif ($_GET['search'] == 'readers') {
                            $readers = mysqli_query($link, "select * from `lms_user` where (`name` like '%{$_GET['object']}%' or `gen_id` like '%{$_GET['object']}%' or `id_card` like '%{$_GET['object']}%') and `admin` = '1'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>UID</th><th>姓名</th><th>学号/工号</th><th>身份证号</th><th>操作</th></tr>";
                            while ($read_readers_row = mysqli_fetch_array($readers)) {
                                echo "<tr>";
                                echo "<td>" . $read_readers_row['id'] . "</td>";
                                echo "<td>" . $read_readers_row['name'] . "</td>";
                                echo "<td>" . $read_readers_row['gen_id'] . "</td>";
                                echo "<td>" . $read_readers_row['id_card'] . "</td>";
                                echo "<td><div><form method='get' action='users.php'><button name='bl_id' class='btn btn-danger' data-toggle='modal' data-target='.Blacklist' value='{$read_readers_row['id']}'>拉黑</button></form></div></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } elseif ($_GET['search'] == 'borrow') {
                            $borrowed = mysqli_query($link, "select * from `lms_borrow` where (`book_name` like '%{$_GET['object']}%' or `book_isbn` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%' or `stu_name` like '%{$_GET['object']}%' or `stu_id` like '%{$_GET['object']}%') and 'if_return' = '1'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>借阅单号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅人姓名</th><th>身份证号</th><th>借阅时间</th><th>归还时间</th><th>是否归还</th></tr>";
                            while ($books_borrowed = mysqli_fetch_array($borrowed)) {
                                echo "<tr>";
                                echo "<td>" . $books_borrowed['id'] . "</td>";
                                echo "<td>" . $books_borrowed['book_name'] . "</td>";
                                echo "<td>" . $books_borrowed['book_isbn'] . "</td>";
                                echo "<td>" . $books_borrowed['book_publisher'] . "</td>";
                                echo "<td>" . $books_borrowed['stu_name'] . "</td>";
                                echo "<td>" . $books_borrowed['stu_id'] . "</td>";
                                echo "<td>" . $books_borrowed['borrow_time'] . "</td>";
                                echo "<td>" . $books_borrowed['return_time'] . "</td>";
                                if ($books_borrowed['if_return'] == 1) {
                                    echo "<td>未归还</td>";
                                } elseif ($books_borrowed['if_return'] == 0) {
                                    echo "<td>已归还</td>";
                                } else {
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }elseif ($_GET['search'] == 'return') {
                            $returned = mysqli_query($link, "select * from `lms_borrow` where (`book_name` like '%{$_GET['object']}%' or `book_isbn` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%' or `stu_name` like '%{$_GET['object']}%' or `stu_id` like '%{$_GET['object']}%') and 'if_return' = '0'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>借阅单号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅人姓名</th><th>身份证号</th><th>借阅时间</th><th>归还时间</th><th>状态</th></tr>";
                            while ($books_returned = mysqli_fetch_array($returned)) {
                                echo "<tr>";
                                echo "<td>" . $books_returned['id'] . "</td>";
                                echo "<td>" . $books_returned['book_name'] . "</td>";
                                echo "<td>" . $books_returned['book_isbn'] . "</td>";
                                echo "<td>" . $books_returned['book_publisher'] . "</td>";
                                echo "<td>" . $books_returned['stu_name'] . "</td>";
                                echo "<td>" . $books_returned['stu_id'] . "</td>";
                                echo "<td>" . $books_returned['borrow_time'] . "</td>";
                                echo "<td>" . $books_returned['return_time'] . "</td>";
                                if ($books_returned['if_return'] == '0'){
                                    echo "<td>已归还</td>";
                                }elseif ($books_returned['if_return'] == '2'){
                                    echo "<td>已归还(逾期)</td>";
                                }else{
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }elseif ($_GET['search'] == 'delay'){
                            $delayed=mysqli_query($link,"select * from `lms_delay` where `book_name` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%' or `applicant_name` like '%{$_GET['object']}%' or `applicant_id` like '%{$_GET['object']}%'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>申请序号</th><th>图书名称</th><th>出版商</th><th>申请人姓名</th><th>身份证号</th><th>延迟到</th><th>操作</th></tr>";
                            while ($delayed_row=mysqli_fetch_array($delayed)){
                                echo "<tr>";
                                echo "<td>".$delayed_row['id']."</td>";
                                echo "<td>".$delayed_row['book_name']."</td>";
                                echo "<td>".$delayed_row['book_publisher']."</td>";
                                echo "<td>".$delayed_row['applicant_name']."</td>";
                                echo "<td>".$delayed_row['applicant_id']."</td>";
                                echo "<td>".$delayed_row['return_time']."</td>";
                                if ($delayed_row['passed'] == '1') {
                                    echo "<td><div><form method='get' action='delay.php'><button name='rl_book_id' class='btn btn-primary' data-toggle='modal' data-target='.myModal1' value='{$delayed_row['id']}'>批准</button></form></div></td>";
                                }else{
                                    echo "<td>已批准</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }elseif ($_GET['forward'] == '1'){
                        if ($_GET['search'] == 'books'){
                            $reader_books=mysqli_query($link, "select * from `lms_books` where `name` like '%{$_GET['object']}%' order by `borrow` desc");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>ID</th><th>名称</th><th>类型</th><th>作者</th><th>ISBN</th><th>出版商</th><th>价格</th><th>页数</th><th>入库时间</th><th>借阅次数</th></tr>";
                            while ($reader_books_row = mysqli_fetch_array($reader_books)) {
                                echo "<tr>";
                                echo "<td>" . $reader_books_row['id'] . "</td>";
                                echo "<td>" . $reader_books_row['name'] . "</td>";
                                echo "<td>" . $reader_books_row['type'] . "</td>";
                                echo "<td>" . $reader_books_row['author'] . "</td>";
                                echo "<td>" . $reader_books_row['isbn'] . "</td>";
                                echo "<td>" . $reader_books_row['publisher'] . "</td>";
                                echo "<td>" . $reader_books_row['price'] . "</td>";
                                echo "<td>" . $reader_books_row['page'] . "</td>";
                                echo "<td>" . $reader_books_row['intime'] . "</td>";
                                echo "<td>" . $reader_books_row['borrow'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }elseif ($_GET['search'] == 'borrowed'){
                            $reader_borrowed=mysqli_query($link,"select * from `lms_borrow` where (`book_name` like '%{$_GET['object']}%' or `book_isbn` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%') and `stu_id` = '{$_SESSION['IDCARD']}'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>借阅单号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅时间</th><th>归还时间</th><th>是否归还</th></tr>";
                            while ($reader_borrowed_row = mysqli_fetch_array($reader_borrowed)) {
                                echo "<tr>";
                                echo "<td>" . $reader_borrowed_row['id'] . "</td>";
                                echo "<td>" . $reader_borrowed_row['book_name'] . "</td>";
                                echo "<td>" . $reader_borrowed_row['book_isbn'] . "</td>";
                                echo "<td>" . $reader_borrowed_row['book_publisher'] . "</td>";
                                echo "<td>" . $reader_borrowed_row['borrow_time'] . "</td>";
                                echo "<td>" . $reader_borrowed_row['return_time'] . "</td>";
                                if ($reader_borrowed_row['if_return'] == '1') {
                                    echo "<td>未归还</td>";
                                } elseif ($reader_borrowed_row['if_return'] == '0') {
                                    echo "<td>已归还</td>";
                                } elseif ($reader_borrowed_row['if_return'] == '2') {
                                    echo "<td>已归还(逾期)</td>";
                                }else{
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }elseif ($_GET['search'] == 'returned') {
                            $reader_returned = mysqli_query($link, "select * from `lms_borrow` where (`book_name` like '%{$_GET['object']}%' or `book_isbn` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%') and `stu_id` = '{$_SESSION['IDCARD']}'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>借阅单号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅时间</th><th>归还时间</th></tr>";
                            while ($reader_returned_row = mysqli_fetch_array($reader_returned)) {
                                echo "<tr>";
                                echo "<td>" . $reader_returned_row['id'] . "</td>";
                                echo "<td>" . $reader_returned_row['book_name'] . "</td>";
                                echo "<td>" . $reader_returned_row['book_isbn'] . "</td>";
                                echo "<td>" . $reader_returned_row['book_publisher'] . "</td>";
                                echo "<td>" . $reader_returned_row['borrow_time'] . "</td>";
                                echo "<td>" . $reader_returned_row['return_time'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }elseif ($_GET['search'] == 'delay'){
                            $reader_delay=mysqli_query($link,"select * from `lms_delay` where (`book_name` like '%{$_GET['object']}%' or `book_publisher` like '%{$_GET['object']}%' or `applicant_name` like '%{$_GET['object']}%' or `applicant_id` like '%{$_GET['object']}%') and `applicant_id` = '{$_SESSION['IDCARD']}'");
                            echo "<br/><table class='table'>";     //使用表格格式化数据
                            echo "<tr><th>申请序号</th><th>借阅序号</th><th>书名</th><th>出版商</th><th>迄</th><th>状态</th></tr>";
                            while ($reader_delay_row=mysqli_fetch_array($reader_delay)){
                                echo "<tr>";
                                echo "<td>".$reader_delay_row['id']."</td>";
                                echo "<td>".$reader_delay_row['book_id']."</td>";
                                echo "<td>".$reader_delay_row['book_name']."</td>";
                                echo "<td>".$reader_delay_row['book_publisher']."</td>";
                                echo "<td>".$reader_delay_row['return_time']."</td>";
                                if ($reader_delay_row['passed'] == '1'){
                                    echo "<td>未批准或被驳回</td>";
                                }elseif ($reader_delay_row['passed'] == '0'){
                                    echo "<td>已批准</td>";
                                }else{
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>