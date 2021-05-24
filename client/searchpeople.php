<?php
require './connection.php';
$conn = openCon();
mysqli_set_charset($conn, 'utf8');
if (isset($_REQUEST['value'])) {
    // $value = $_REQUEST['value'];
    $value = '%'.$_REQUEST['value'].'%';
    $query = "select * from `tacgia` WHERE tacgia_ten LIKE '".$value."'";
    // echo $query;
    $result = mysqli_query($conn, $query);
    $myObj = mysqli_fetch_all($result);
    echo json_encode( $myObj, JSON_UNESCAPED_UNICODE );
}
