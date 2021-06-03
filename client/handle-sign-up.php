<?php 
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    include './connection.php';
    $conn = openCon();
    $sqlCheckUsername = "SELECT a_username from taikhoan where a_username = '".$username."'";
    $resultCheckUsername = mysqli_query($conn, $sqlCheckUsername);
    $sqlGetNumberOfUser = mysqli_query($conn, "SELECT * FROM tacgia");
    $id = mysqli_num_rows($sqlGetNumberOfUser)+1;
    if(mysqli_num_rows($resultCheckUsername) === 0) {
        mysqli_query($conn, "INSERT INTO tacgia (tacgia_id, tacgia_ten) VALUES ($id,'".$username."')");
        $sql = "INSERT INTO taikhoan (a_id ,a_username, a_password, a_question, a_answer) VALUES ($id,'".$username."', '".$password."', '".$question."', '".$answer."')";
        mysqli_query($conn, $sql);
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
                    window.location.href = './signup.php';
                </script>
                ";
    }
    closeCon($conn);
?>