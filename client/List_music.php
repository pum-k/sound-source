<?php
$start = 1;
if (isset($_REQUEST['page']) && $_REQUEST['page'] > 1) {
    $index = $_REQUEST['page'] - 1;
    $start *= $index * 10;
}
$end = $start + 10;
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
$conn->set_charset("utf8");
$db = "sound-source";
$conn->select_db($db);
$statment = 'SELECT * FROM `baihat`';
$result = mysqli_query($conn, $statment);
$array = array();
while ($row = $result->fetch_assoc()) {
    if ($start == $row['baihat_id'] && $start < $end) {
        array_push($array, $row);
        $start++;
    }
}
echo json_encode($array);
