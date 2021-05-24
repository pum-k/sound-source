<?php
// require './connection.php';
$servername =  "localhost";
$username =   "root";
$password =   "";
$conn = @new mysqli($servername, $username, $password, "sound-source");
mysqli_set_charset($conn, 'utf8');
if (isset($_REQUEST['value'])) {

}
