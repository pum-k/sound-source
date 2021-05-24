<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="ctn-login">
        <h1 class="title">Sign up</h1>
        <div class="ctn-new-account"><p style="margin-right: 5px;">Already have an account?</p><a href="./login.php">Sign in</a></div>
        <form class="form-login" action="handle-sign-up.php" method="POST" onsubmit = "return checkConfirmPassword()">
            <input autocomplete="off" type="text" placeholder="Username" name="username" required minlength="5"/>
            <input type="password" placeholder="Password" name="password" required minlength="6"/>            
            <input type="password" placeholder="Confirm Password" name="confirmPassword" required minlength="6"/>
            <select class="question" name="question" id="question" required>
                <option value="">Verification Question</option>
                <option value="father">Your father's name?</option>
                <option value="mother">Your mother's name?</option>'
                <option value="pet">Your favorite pet?</option>
                <option value="book">Your favorite book?</option>
            </select>
            <input type="text" placeholder="Your answer" name="answer" autocomplete="off" required minlength="5"/>
            <input class="submit" type="submit" />
        </form>
    </div>
</body>
<script src="./Notification.js"></script>
<script>
    let validate = <?php session_start(); echo json_encode($_SESSION["validate-sign-up"], JSON_HEX_TAG); ?>;
    if(validate === true) {
        notification('success',"Sign up success, please wait...");
        setTimeout(()=>{
            window.location.replace('login.php');
        }, 4000);
    }
    if(validate === false)
        notification('error',"Username has existed, please try again");

    <?php
        $_SESSION["validate-sign-up"] = '';  
    ?>

    const checkConfirmPassword = () => {
        let password = document.getElementsByName('password')[0];
        console.log(password);
        let confirmPassword = document.getElementsByName('confirmPassword')[0];
        if(password.value != confirmPassword.value) {
            password.style.border = '1px solid red';
            confirmPassword.style.border = '1px solid red';
            return false;
        } else {
            password.style.border = '0.5px solid green';
            confirmPassword.style.border = '0.5px solid green';
            return true;
        }
    }
</script>
</html>