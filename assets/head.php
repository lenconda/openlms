<nav class="navbar navbar-default">
    <div class="container">
        <!--响应式导航栏-->
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">图书管理系统</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" method="get" action="search.php">
                    <select class="form-control" name="search">
                        <option value="books">按图书名称</option>
                        <option value="readers">按读者</option>
                        <option value="borrow">按借出</option>
                        <option value="return">按归还</option>
                        <option value="delay">按延迟</option>
                    </select>
                    <div class="form-group">
                        <input type="hidden" value="0" name="forward">
                        <input type="text" class="form-control" name="object" placeholder="查询内容">
                    </div>
                    <button type="submit" class="btn btn-default">查询</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php session_start();echo $_SESSION['NAME']?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="book_admin.php">图书管理</a></li>
                            <li><a href="users.php">用户管理</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-toggle="modal" data-target=".myModal_Modpf">修改信息</a></li>
                            <li><a data-toggle="modal" data-target=".myModal_Modpw">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php?action=logout">退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div><!-- /.container-fluid -->

    <div class="modal fade myModal_Modpw"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>修改密码</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <form method="post">
                        <?php
                            session_start();
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $admin_info=mysqli_query($link,"select * from `lms_user` where `id`='{$_SESSION['UID']}'");
                            $admin_info_row=mysqli_fetch_array($admin_info);
                            echo "<input type='password' style='width: auto' name='oldpw' class='form-control' placeholder='输入原密码'><br/>";
                            echo "<input type='password' style='width: auto' name='newpw' class='form-control' placeholder='输入新密码'><br/>";
                            echo "<input type='password' style='width: auto' name='confirm' class='form-control' placeholder='确认新密码'><br/>";
                            echo "<br/><div class='modal-footer'><input type='submit' name='modpw' class='btn btn-danger' value='确定'><a data-dismiss='modal' class='btn btn-default'>取消</a></div>";
                            if (isset($_POST['modpw'])){
                                if ($_POST['oldpw'] == ''){
                                    echo "<script>alert('未输入原密码')</script>";
                                }elseif($_POST['oldpw'] != $admin_info_row['password']){
                                    echo "<script>alert('原密码输入错误')</script>";
                                }elseif($_POST['newpw'] == ''){
                                    echo "<script>alert('未输入新密码')</script>";
                                }elseif ($_POST['confirm'] == ''){
                                    echo "<script>alert('未确认新密码')</script>";
                                }elseif($_POST['newpw'] != $_POST['confirm']){
                                    echo "<script>alert('两次输入密码不一致')</script>";
                                }else{
                                    $modpw=mysqli_query($link,"UPDATE `lms_user` SET `password`='{$_POST['newpw']}' WHERE `lms_user`.`id` = '{$_SESSION['UID']}'");
                                    if (!$modpw){
                                        echo "<script>alert('修改密码失败')</script>";
                                    }else{
                                        echo "<script>alert('修改密码成功')</script>";
                                        echo "<script>window.location.href='logout.php?action=logout'</script>";
                                    }
                                }
                            }
                        ?>
                    </form>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>

    <div class="modal fade myModal_Modpf"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>修改信息</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <form method="post">
                        <?php
                            session_start();
                            $update_act=mysqli_query($link,"select * from `lms_user` where `id`='{$_SESSION['UID']}'");
                            $update_act_row=mysqli_fetch_array($update_act);
                            echo "<label for='stu_name'>姓名</label>";
                            echo "<input name='stu_name' id='stu_name' class='form-control' type='text' style='width: auto' value='{$update_act_row['name']}'><br/>";
                            echo "<label for='gen_id'>学号/工号</label>";
                            echo "<input name='gen_id' id='gen_id' class='form-control' type='text' style='width: auto' value='{$update_act_row['gen_id']}'><br/>";
                            echo "<label for='id_card'>身份证号</label>";
                            echo "<input name='id_card' id='id_card' class='form-control' type='text' style='width: auto' value='{$update_act_row['id_card']}'><br/>";
                            echo "<div class='modal-footer'><input type='submit' name='update_admin' value='确定' class='btn btn-danger'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                            if (isset($_POST['update_admin'])){
                                if ($_POST['stu_name'] == ''){
                                    echo "<script>alert('未填写姓名')</script>";
                                }elseif($_POST['gen_id'] == ''){
                                    echo "<script>alert('未填写学号/工号')</script>";
                                }elseif($_POST['id_card'] == ''){
                                    echo "<script>alert('未填写身份证号')</script>";
                                }else{
                                    $modify=mysqli_query($link,"UPDATE `lms_user` SET `name`='{$_POST['stu_name']}', `id_card` = '{$_POST['id_card']}', `gen_id` = '{$_POST['gen_id']}' WHERE `lms_user`.`id` = '{$_SESSION['UID']}'");
                                    if (!$modify){
                                        echo "<script>alert('修改失败')</script>";
                                    }else{
                                        echo "<script>alert('修改成功')</script>";
                                        echo "<script>window.location.href='jump.php?jump=index.php'</script>";
                                    }
                                }
                            }
                        ?>
                    </form>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>
</nav>
