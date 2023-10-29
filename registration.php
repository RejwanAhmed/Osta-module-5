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
                <marquee><h3>Welcome To Registration</h3></marquee>
                <hr>
                <!-- To Show Error -->
                <div class="text-center alert alert-danger alert-dismissible fade show" role="alert" style = "display:none" id = "all-error-div">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                    <strong id = "all-error"></strong> 
                </div>
                
                <form action="" method = "POST">
                    <!-- UserName -->
                    <div class="form-group mt-2">
                        <label for="">User Name: <strong class = "text-danger">*</strong> </label>
                        <input class = "form-control" type="text" name = 'userName' placeholder = "Enter User Name" value = "<?php echo isset($_POST['userName']) ? $_POST['userName'] : "" ?>">
                    </div>
                    
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
                        <input class = "btn btn-color" type="submit" name = "register" value = "Register">
                        <a href="login.php" class = "text-danger fw-bold a-login mt-2">Already Registered!! Login</a>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
<?php
include 'lib/footer.php';
?>
<?php 
    // form submission
    if( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register']) ){
        $userName = trim($_POST['userName']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // All fields must be filled
        if($userName == "" || $email == "" || $password == ""){
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
        
        // Password must be at least 8 characters
        if(strlen($password)<8){
            ?>
                <script>
                    document.getElementById('all-error-div').style = "display:block";
                    document.getElementById('all-error').innerHTML = "Password Must Be At Least 8 Characters!!";
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
            
            // if email already exists
            if(isset($user[$email])){
                ?>
                    <script>
                        document.getElementById('all-error-div').style = "display:block";
                        document.getElementById('all-error').innerHTML = "Sorry !! Email Already Exists!!";
                    </script>
                <?php
                exit();
            }else {
                $newUserdata = [
                     'userName' => $userName,
                     'email' => $email,
                     'password' => $password
                ];
                $user[$email] = $newUserdata;
                
                $encodedData = json_encode($user, JSON_PRETTY_PRINT);
                file_put_contents($fileName, $encodedData);
                
                ?>
                    <script>
                        window.alert("Registration Successfully Completed!!");
                        window.location = "login.php";
                    </script>
                <?php 
            }
        }
    }
?>
