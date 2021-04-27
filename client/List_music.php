<?php
$count = 10;
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
$conn -> set_charset("utf8");
$db = "sound-source";
$conn->select_db($db);
$statment = 'SELECT * FROM `baihat`';
$result = mysqli_query($conn, $statment);
while ($row = $result->fetch_assoc()) {
    echo '<button class="song" id="'. $row['baihat_id'].'" onclick="myFunction(this)">';
    echo '<i class="fas fa-play play song__play"></i>';
    echo '<div class="song-img" style="background-image: url('.$row['baihat_image'].');"></div>';
    echo '<p class="song-info">'.$row['baihat_ten'] .'</p>';
    echo '<p class="song-info">artist name</p>';
    echo '<p class="song-audio" hidden> '.$row['baihat_url'].'</p>';

    echo '</button>';
    $count--;
}
