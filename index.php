<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
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
    <title>图书管理系统</title>
    <?php
        include "config/config_inc.php";
    ?>
  </head>
  <body>
        <?php
            include "assets/head.php";
            include "assets/sidebar.php";
        ?>

        <div class="col-md-10">
            <div class="row">
                    <table class="table" align="top">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>出版商</th>
                            <th>页数</th>
                            <th>价格</th>
                            <th>ISBN</th>
                            <th>入库时间</th>
                            <th>借阅次数</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td><form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form></td>
                        </tr>
                    </table>
                <div class="md-modal md-effect-3" id="modal-3">
                    <div class="md-content" style="border: thin">
                        <h3>Modal Dialog</h3>
                        <div>
                            <p>This is a modal window. You can do the following things with it:</p>
                            <ul>
                                <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
                                <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
                                <li><strong>Close:</strong> click on the button below to close the modal.</li>
                            </ul>
                            <button class="md-close btn-sm btn-primary">Close me!</button>
                        </div>
                    </div>
                </div>
                <script src="js/classie.js"></script>
                <script src="js/modalEffects.js"></script>
            </div>
        </div>


  </body>
</html>