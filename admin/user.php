<?php
$rtrnUsername ="";
$names = "";
$phone = "";
$email = "";
if (isset($_POST['regist']))
{
    $username = $_POST['username'];

    $newUser = array(
        'names' =>$_POST['names'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'role' => $_POST['role'],
        'username' => $_POST['username'],
        'password'=>$_POST['password'],
        'profile' => 'avatar7.png'
    );
    $checkUser = $con->singleTable('users','username',$username);
    
    if(!empty($checkUser))
    {
        $rtrnUsername = "username have been used";
    }
    else{
        $newUser = $con->insert('users',$newUser);
        if($newUser)
        {?>
            <script type="text/javascript">
                                            $(document).ready(function() {
                                                window.location.href = "dashboard.php?users";

                                            });
                                        </script><?php
        }
    }
}

?>
<section class="post">
    <h2> Add New User In Your Team</h2>
    <div class="container">
        <section class="post">
            <div class="week-form">
                <div class="form">
                    <form action="" method="POST" id="form-id">
                        <label for="names">Full Names</label>
                        <input type="text" name="names" placeholder="Full Name" id="names" value="<?php echo $names; ?>">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" placeholder="User phone" id="phone" value="<?php echo $phone; ?>">
                        <label for="email">Full Names</label>
                        <input type="text" name="email" placeholder="User email" id="email" value="<?php echo $email; ?>">
                        
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <option>--Role--</option>
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                        </select>
                        
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Create Username">
                        <span style="color:red; font-size:small"><?php echo $rtrnUsername ."<br>";?></span>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Create Password">
                        <input type="submit" name="regist" id="btn_Send" value="REGISTOR">
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
