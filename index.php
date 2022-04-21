<?php
    include"connect.php";
    error_reporting(1);
    session_start();
    $_SESSION["err"] = "";
    if (isset($_POST["submit"])) {

      $username = $_POST["txtUsername"];
      $password = $_POST["txtPassword"];


      $get_current_user_details = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";

      $execute_user_details_command = mysqli_query($con, $get_current_user_details);
      $get_additional_info = mysqli_fetch_assoc($execute_user_details_command);

      $_SESSION['login_user'] = $get_additional_info["username"];

      $user_validity = mysqli_num_rows($execute_user_details_command);

      if ($user_validity > 0) {

        $login_session = $row['username'];
          header("location: Dashboard/index.php");
      } else {
        $_SESSION["err"] = "Wrong Username or Password";
      }
    }
    ?>


<?php
if(!empty($_SESSION['login_user']))
    {header("location: Dashboard/index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Report |Login</title>
    <link rel="stylesheet" href="assets/Login_css/style.css">
    <link rel="stylesheet" href="">
</head>

<body>
    <header>

        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Reports</span> System</h1>
            </div>
        </div>
    </header>
    <section>
        <form class='login-form' method="post">
            <div class="flex-row">
                <input id="username" class='lf--input' placeholder='Username' type='text' name="txtUsername">
            </div>
            <div class="flex-row">
                <input id="password" class='lf--input' placeholder='Password' type='password' name="txtPassword">
            </div>
            <input class='lf--submit' type='submit' value='LOGIN' name="submit" id="btnSubmit">


        </form>

        <label id="lf--errormsg"
            style="font-size:.7em;color:red;text-align:center;cursor:hand"><?php echo ($_SESSION["err"]); ?></label>
    </section>

</body>

</html>