<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREW</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class = "body-color">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark nav-bg-color">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">CREW <?php echo isset($_SESSION['role']) ? "(".$_SESSION['role'].")" : ""?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class=" navbar-nav navbar-nav-scroll">
                        <?php 
                            if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="all_users.php">All Users</a>
                                    </li>
                                <?php 
                            }
                        ?>
                    </ul>
     
                    <ul class=" navbar-nav navbar-nav-scroll ms-auto">
                        <?php 
                            if(isset($_SESSION['userName'])){
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                <?php 
                            }else {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="registration.php">Register</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Login</a>
                                    </li>
                                <?php 
                            }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
