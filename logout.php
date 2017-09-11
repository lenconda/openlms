<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<?php
    if ($_GET['action'] == 'logout'){
        session_destroy();
        echo "<script>window.location.href='login.php'</script>";
    }
?>