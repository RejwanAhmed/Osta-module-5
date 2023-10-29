<?php 

function loggedInPagesSession(){
    if(!isset($_SESSION['userName'])){
        ?>
            <script>
                window.location = "index.php";
            </script>
        <?php
        exit();
    }
}

function loggedInAdminRoleSession(){
    if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){
        ?>
            <script>
                window.location = "admin_dashboard.php";
            </script>
        <?php
        exit();
    }
}
function loggedInUserRoleSession(){
    if(isset($_SESSION['role']) && $_SESSION['role']=="user"){
        ?>
            <script>
                window.location = "user_dashboard.php";
            </script>
        <?php
        exit();
    }
}
function loggedInManagerRoleSession(){
    if(isset($_SESSION['role']) && $_SESSION['role']=="manager"){
        ?>
            <script>
                window.location = "manager_dashboard.php";
            </script>
        <?php
        exit();
    }
}
function loggedInWithoutRoleSession(){
    if(isset($_SESSION['role']) && $_SESSION['role']=="guest"){
        ?>
            <script>
                window.location = "dashboard.php";
            </script>
        <?php
        exit();
    }
}
?>