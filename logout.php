<?php 
session_start();
include 'session.php';
// for checking session
loggedInPagesSession();
session_destroy();
?>
<script>
    window.location = "login.php";
</script>