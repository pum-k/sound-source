<?php
$servername =  "localhost";
$username =   "root";
$password =   "";
$conn = @new mysqli($servername, $username, $password, "sound-source");
mysqli_set_charset($conn, 'utf8');
if (isset($_REQUEST['value'])) {
    // $value = $_REQUEST['value'];
    $value = '%'.$_REQUEST['value'].'%';
    $query = "select baihat_ten,baihat_url,baihat_image, tacgia_ten FROM baihat as b inner join tacgia as t WHERE b.baihat_ten like '$value' and b.tacgia_id = t.tacgia_id";
    $result = mysqli_query($conn, $query);
    $myObj = mysqli_fetch_all($result);
    echo json_encode( $myObj, JSON_UNESCAPED_UNICODE );
}