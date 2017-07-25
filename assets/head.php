<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!--响应式导航栏-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">图书管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" method="get">
                <select class="form-control">
                    <option>查询图书</option>
                    <option>查询读者</option>
                </select>
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="查询内容">
                </div>
                <button type="submit" class="btn btn-default">查询</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$_SESSION['Name']<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="book_admin.php">图书管理</a></li>
                        <li><a href="users.php">用户管理</a></li>
                        <li><a href="#">个人中心</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">账号设置</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php?action=logout">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
