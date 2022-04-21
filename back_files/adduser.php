<?php
if (!empty($_POST["names"]) && !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["role"]) && !empty($_POST["username"]) && !empty($_POST["password"]))
{
    $names = $_POST['names'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkUser = mysqli_query($con, "SELECT * FROM users WHERE `username` = '$username'");
    if(mysqli_num_rows($checkUser) > 0 )
    {
        $rtrnUsername = "username have been used";
        echo json_encode(['code'=>404, 'msg'=>$rtrnUsername]);
    }
    else{
        $newUser = mysqli_query($con, "INSERT INTO `users` (`names`,`email`,`phone`,`role`,`username`,`password`,`profile`) 
        VALUES('$names','$email','$phone','$role','$username','$password','avatar7.png')");

        if($newUser)
        {
            $msg = "we good";
            echo json_encode(['code'=>200, 'msg'=>$msg]);
        }
    }
}

?>
<section class="post">
    <h2> Weekly Report</h2>
    <p class="ttle"> Report you progress on this project in this week </p>
    <div class="container">
        <section class="post">
            <div class="week-form">
                <div class="form">
                    <form action="" method="POST" id="form-id">
                        <label for="names">Full Names</label>
                        <input type="text" name="name" placeholder="Full Name" id="names">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" placeholder="User phone" id="phone">
                        <label for="email">Full Names</label>
                        <input type="text" name="email" placeholder="User email" id="email">
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <option>--Role--</option>
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                        </select>
                        
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Create Username">
                        
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" placeholder="Create Password">
                        <input type="submit" name="registo" id="btn_Send" value="REGISTOR">
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>


<script type="text/javascript">
$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
        names: $("#names").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        role: $("#role").val(),
        username: $("#username").val(),
        password: $("#password").val(),
    };

    $.ajax({
      type: "POST",
      url: "",
      dataType: "json",
      encode: true,
      data: formData,
    success : function(data){
        if (data.code == "200"){
            alert("Success: " +data.msg);
            } else {
                $(".display-error").html("<ul>"+data.msg+"</ul>");
                $(".display-error").css("display","block");
            }
        }
      
    }).done(function (data) {
      console.log(data);
    });

    event.preventDefault();
  });
});
</script>