<?php
    if ($_GET['action'] == 'logout'){
        session_destroy();
        echo "<script>window.location.href='login.php'</script>";
    }
?>