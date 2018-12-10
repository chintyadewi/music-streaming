<?php
    session_start();
    if(session_destroy()){
        header("Location: index.php");
    }
?>
<script>
	alert("Anda akan keluar"); 
	document.location.href="index.php";
</script>