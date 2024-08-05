<?php
    session_start();
    setcookie("adphim","",time()-3600);
    session_unset();
    session_destroy();
    //header("Refresh:0");
    //header("location:index.php");
    
?>
<script>
    history.go(-1);
    //window.location.reload();
</script>