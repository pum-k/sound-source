<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="./login.css" />
  </head>
  <body>
    <div class="ctn-login">
      <h1 class="title">Sign in</h1>
      <div class="ctn-new-account">
        <p style="margin-right: 5px">If you haven't an account yet?</p>
        <a href="./signup.php">Click here</a>
      </div>
      <form class="form-login" action="handle-login.php" method="POST">
        <input
          autocomplete="off"
          type="text"
          placeholder="Username"
          name="username"
          required
          minlength="5"
        />
        <input
          type="password"
          placeholder="Password"
          name="password"
          required
          minlength="5"
        />
        <input class="submit" type="submit" value="Sign in" />
      </form>
      <a href="forgot-pass.php">Forgot your password?</a>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="./Notification.js"></script>
  <script>
      let validate = <?php session_start(); echo json_encode($_SESSION["validate-login"], JSON_HEX_TAG); ?>;
      if(validate === true){
        notification('success',"Sign in success, please wait...");
        setTimeout(()=>{
          location.replace("./index.php");
        },3500);
      }
      if(validate === false)
        notification('error',"Your username or password is incorrect, please check and try again");
      <?php
        $_SESSION["validate-login"] = '';  
      ?>
  </script>
</html>
