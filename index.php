<?php 
include 'lib/header.php';
include 'session.php';
// for checking session
loggedInUserRoleSession();
loggedInManagerRoleSession();
loggedInWithoutRoleSession();
loggedInAdminRoleSession();
?>
<h1 class = "text-center mt-2">Welcome To Home Page</h1>
<h3 class = "text-center"><span class = "text-danger">Sorry!!</span> There is nothing now</h3>
<h3 class = "text-center"><span class = "text-success">You can register or Login</span></h3>
<?php 
include 'lib/footer.php';
?>