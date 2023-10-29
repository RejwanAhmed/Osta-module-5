<?php
include 'lib/header.php';
include 'session.php';
// for checking session
loggedInUserRoleSession();
loggedInManagerRoleSession();
loggedInWithoutRoleSession();
loggedInAdminRoleSession();
?>
    <div class="container" >
        <div class="row justify-content-center d-flex align-items-center" style = "height: 86vh">
            <div class="col-lg-6 col-md-8 col-12 form-color shadow rounded p-3">
                <marquee><h3>Welcome To Login</h3></marquee>
                <hr>
                <!-- To Show Error -->
                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert" style = "display:none" id = "all-error-div">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                    <strong id = "all-error"></strong> 
                </div>
                
                <form action="" method = "POST">
                    <!-- Email -->
                    <div class="form-group mt-2">
                        <label for="">Email: <strong class = "text-danger">*</strong> </label>
                        <input class = "form-control" type="email" name = 'email' placeholder = "Enter Email" value = "<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>">
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group mt-2">
                        <label for="">Password: <strong class = "text-danger">*</strong> </label>
                        <input class = "form-control" type="password" name = 'password' placeholder = "Enter Password" value = "">
                    </div>
                    
                    <div class="form-group mt-2 d-flex justify-content-between">
                        <input class = "btn btn-color" type="submit" name = "login" value = "Login">
                        <a href="registration.php" class = "text-danger fw-bold a-login mt-2">Not Registerd Yet!! Register</a>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
<?php
// include 'lib/footer.php';
?>
<?php  
    // form submission
    if( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']) ){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // All fields must be filled
        if($email == "" || $password == ""){
            ?>
                <script>
                    document.getElementById('all-error-div').style = "display:block";
                    document.getElementById('all-error').innerHTML = "All Fields Are Required!!";
                </script>
            <?php
            exit();
        }
        
        // Email Validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            ?>
                <script>
                    document.getElementById('all-error-div').style = "display:block";
                    document.getElementById('all-error').innerHTML = "Invalid Email Address!!";
                </script>
            <?php
            exit();
        }
        
        // Password Hashing
        $password = md5($password);
        
        // File Directory
        $fileName = "user_information.txt";
        
        // Chekcing if file exists
        if(file_exists($fileName)){
            $data = file_get_contents($fileName);
            $user = json_decode($data, true);
            
            // if email and password matches
            if(isset($user[$email]) && $user[$email]['password'] == $password){
                // $redirection = "";
                // if there is a role
                if(isset($user[$email]['role'])){
                    $_SESSION['userName'] = $user[$email]['userName'];
                    $_SESSION['email'] = $user[$email]['email'];
                    $_SESSION['role'] = $user[$email]['role'];
                    
                    // re-direction according to role
                    if($user[$email]['role'] == "admin"){
                        $redirection = "admin_dashboard.php";
                    }else if($user[$email]['role'] == "user"){
                        $redirection = "user_dashboard.php";
                    }else{
                        $redirection = "manager_dashboard.php";
                    }
                }
                else {
                    // if there is no role i have set it to guest.
                    $_SESSION['userName'] = $user[$email]['userName'];
                    $_SESSION['email'] = $user[$email]['email'];
                    $_SESSION['role'] = "guest";
                    // if no role assigned redirect to dashboad 
                    $redirection = "dashboard.php";
                }
                ?>
                    <script>
                        window.location = "<?php echo $redirection ?>";
                    </script>
                <?php
            }else {
                ?>
                    <script>
                        document.getElementById('all-error-div').style = "display:block";
                        document.getElementById('all-error').innerHTML = "Wrong Email Address Or Password!!";
                    </script>
                <?php 
            }
        }
    }
?>
