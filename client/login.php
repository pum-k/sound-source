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
        <a href="./signup.html">Click here</a>
      </div>
      <form
        class="form-login"
        action="handleLogin.php"
        method="POST"
        onsubmit="return (validation() && checkLogin())"
      >
        <input
          autocomplete="off"
          type="text"
          placeholder="Username"
          name="username"
          onclick="handleInput()"
        />
        <input
          type="password"
          placeholder="Password"
          name="password"
          onclick="handleInput()"
        />
        <input class="submit" type="submit" value="OK" />
      </form>
      <a href="forgot-pass.html">Forgot your password?</a>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    const validation = () => {
      let username = document.getElementsByName("username");
      let password = document.getElementsByName("password");
      let check = true;
      if (username[0].value === "") {
        username[0].style.border = "1px solid red";
        username[0].style.color = "red";
        username[0].placeholder = "Username cannot be blank";
        check = false;
      }
      if (password[0].value === "") {
        password[0].style.border = "1px solid red";
        password[0].style.color = "red";
        password[0].placeholder = "Password cannot be blank";
        check = false;
      }
      return check;
    };

    const handleInput = (event) => {
      let username = document.getElementsByName("username");
      let password = document.getElementsByName("password");
      username[0].style.border = "0.5px solid black";
      username[0].style.color = "black";
      password[0].style.border = "0.5px solid black";
      password[0].style.color = "black";
      username[0].placeholder = "Username";
      password[0].placeholder = "Password";
    };

    const checkLogin = () => {
      $.ajax({
        url: 'handleLogin.php',
        type: "post",
        success: function (response) {
        console.log(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
           console.log('error');
        }
      })
    };
  </script>
</html>
