<?php
    $servername =  "localhost" ;       
    $username =   "root"     ;
    $password =   ""    ;
    $conn = @new mysqli($servername, $username, $password , "sound-source");
    mysqli_set_charset( $conn, 'utf8');
    $value = $_REQUEST['value'];
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $query = "SELECT baihat_ten FROM baihat where MATCH(baihat_ten) AGAINST( '%$value%' )";
    $result = mysqli_query($conn, $query);
    $myObj = mysqli_fetch_all($result);
    echo json_encode( $myObj, JSON_UNESCAPED_UNICODE );
?>