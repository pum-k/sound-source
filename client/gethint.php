<?php
    $servername =  "localhost" ;       
    $username =   "root"     ;
    $password =   ""    ;
    ;//create connection
    $conn = @new mysqli($servername, $username, $password , "sound-source");
    mysqli_set_charset( $conn, 'utf8');
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $query = "SELECT baihat_ten FROM baihat";
    $result = mysqli_query($conn, $query);
    $myObj = mysqli_fetch_all($result);
    // json_encode( $myObj, JSON_UNESCAPED_UNICODE );

    echo json_encode( $myObj, JSON_UNESCAPED_UNICODE );



?>