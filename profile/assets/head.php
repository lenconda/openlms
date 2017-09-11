<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<nav class="navbar navbar-default">
    <div class="container">
        <!--响应式导航栏-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">个人中心</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" method="get" action="../search.php">
                <select class="form-control" name="search">
                    <option value="books">按图书名称</option>
                    <option value="borrowed">按借入</option>
                    <option value="returned">按归还</option>
                    <option value="delay">按延迟</option>
                </select>
                <div class="form-group">
                    <input type="hidden" value="1" name="forward">
                    <input type="text" class="form-control" name="object" placeholder="查询内容">
                </div>
                <button type="submit" class="btn btn-default">查询</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php session_start(); echo $_SESSION['NAME'];?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php">个人资料</a></li>
                        <li><a href="borrowed.php">借书记录</a></li>
                        <li><a href="returned.php">归还记录</a></li>
                        <li><a href="delay.php">延迟归还申请</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../logout.php?action=logout">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
