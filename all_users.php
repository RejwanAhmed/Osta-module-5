<?php 
include 'lib/header.php';
include 'session.php';
// for checking session
loggedInPagesSession();
loggedInUserRoleSession();
loggedInManagerRoleSession();
loggedInWithoutRoleSession();
?>
<div class="container">
    <div class="row mt-4 justify-content-center">
        <div class="col-lg-10 col-md-10 col-12 shadow bg-white ">
            <table class = "table table-bordered mt-2 text-center">
                <h4 class = "text-center">All Registered Users</h4>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $fileName = "user_information.txt";
                        $userInformation = file_get_contents($fileName);
                        $data = json_decode($userInformation, true);
                        
                        foreach($data as $user){
                            // not to show his own information
                            if(($_SESSION['email'] != $user['email'])){
                            ?>
                                <tr>
                                    <td><?php echo $user['userName'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo isset($user['role']) ? $user['role'] : "--" ?></td>
                                    <td>
                                        <form action="" method = "POST">
                                            <input type="hidden" name = "email" value = "<?php echo $user['email'] ?>">
                                            <select name="role" id="" class = "btn btn-light">
                                                <option value="">Please Select</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                                <option value="manager">Manager</option>
                                            </select>
                                            <input class = "btn btn-color" type="submit" name = "assign" value = "Assign">
                                        </form>
                                    </td>
                                </tr>
                            <?php             
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
// include 'lib/footer.php';
?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['assign'])){
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        // File Directory
        $fileName = "user_information.txt";
        
        // Chekcing if file exists
        if(file_exists($fileName)){
            $data = file_get_contents($fileName);
            $user = json_decode($data, true);
            
            if(isset($user[$email])){
                if(!empty($role)){
                    // if role field is not empty add the role
                    $newUserdata = [
                        'userName' => $user[$email]['userName'],
                        'email' => $user[$email]['email'],
                        'password' => $user[$email]['password'],
                        'role' => $role
                    ];
                    $user[$email] = $newUserdata;
                } else {
                    // if role field is empty then remove previous role
                    $newUserdata = [
                        'userName' => $user[$email]['userName'],
                        'email' => $user[$email]['email'],
                        'password' => $user[$email]['password'],
                    ];
                    $user[$email] = $newUserdata;
                }
                $encodedData = json_encode($user, JSON_PRETTY_PRINT);
                file_put_contents($fileName, $encodedData);
            }
            
            ?>
                <script>
                    window.alert('Role Updated');
                    window.location = "all_users.php";
                </script>
            <?php 
        }
    }
?>