<?php

    include './connection.php';
    $conn = openCon();

    $sqlArtist = "SELECT tacgia_ten FROM tacgia WHERE tacgia_id = '".$_POST["tacgia_id"]."'";
    $result = mysqli_query($conn, $sqlArtist);
    print_r (json_encode(mysqli_fetch_assoc($result)));
    closeCon($conn);
?>