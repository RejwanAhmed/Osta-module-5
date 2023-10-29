<?php 
include 'lib/header.php';
include 'session.php';
// for checking session
loggedInPagesSession();
loggedInAdminRoleSession();
loggedInManagerRoleSession();
loggedInWithoutRoleSession();
?>
<h1 class = "text-center mt-2">Welcome To Dashboard of User</h1>
<h3 class = "text-center">You are assigned as: <span class = "text-danger"><?php echo $_SESSION['role'] ?></span> </h3>
<?php 
include 'lib/footer.php';
?>