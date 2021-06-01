<?php
    session_start();
    include ("connection.php");
    $conn = openCon();
    $username = $_POST['username'];
    $password = $_POST['password'];

    session_start();
    $sql = "SELECT * from taikhoan WHERE a_username='".$username."' AND a_password='".$password."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION["username"]= $row['a_username'];
            $_SESSION["userId"] = $row['a_id'];
            echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-login', true);
                    setValidate('user', true);
                    window.location.href = './login.php';
                </script>
                ";
            closeCon($conn);
            exit();
        }
        } else {
            echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                        setValidate('validate-login', false);
                        window.location.href = './login.php';
                </script>
                ";
            closeCon($conn);
            exit();
        }
   
?>