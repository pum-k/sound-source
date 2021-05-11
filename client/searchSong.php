<?php
$servername =  "localhost";
$username =   "root";
$password =   "";
$conn = @new mysqli($servername, $username, $password, "sound-source");
mysqli_set_charset($conn, 'utf8');
if (isset($_REQUEST['value'])) {
    $value = $_REQUEST['value'];
    $query = "SELECT * ,tacgia_ten FROM baihat INNER JOIN tacgia ON tacgia.tacgia_id = baihat.tacgia_id where MATCH(baihat_ten) AGAINST( '%$value%' )";
    $result = mysqli_query($conn, $query);
    $myObj = mysqli_fetch_all($result);
    echo json_encode( $myObj, JSON_UNESCAPED_UNICODE );
}