<?php 
    session_start();

    $username = $_POST['username'];
    $password = $_POST['newPassword'];
    $rePassword = $_POST['rePassword'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    include './connection.php';
    $conn = openCon();

    $sqlCheckUsername = "SELECT a_username from taikhoan where a_username = '".$username."'";
    $resultCheckUsername = mysqli_query($conn, $sqlCheckUsername);
    if(mysqli_num_rows($resultCheckUsername) === 0) {
        $sql = "INSERT INTO account (a_username, a_password, a_question, a_answer) VALUES ('".$username."', '".$password."', '".$question."', '".$answer."')";
        $resultInsert = mysqli_query($conn, $sql);
        echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-sign-up', true);
                    window.location.href = './signup.php';
                </script>
                ";
    } else {
        echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-sign-up', false);
                    window.location.href = './signu.php';
                </script>
                ";
    }
    closeCon($conn);
?>