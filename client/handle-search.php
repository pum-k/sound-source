<?php
    session_start();
    include './connection.php';
    $conn = openCon();
    $tracks = array();
    $artist;
    $valueSearch = '%'.$_POST['search'].'%';
    $_SESSION['search'] = $_POST['search'];
    $sqlTracks = "select baihat_ten,baihat_url,baihat_image, tacgia_ten FROM baihat as b inner join tacgia as t WHERE b.baihat_ten like '".$valueSearch."' and b.tacgia_id = t.tacgia_id";
    $resultTracks = mysqli_query($conn, $sqlTracks);
    $i = 0;
    if($resultTrack = mysqli_fetch_all($resultTracks)){
        $tracks[$i] = $resultTrack;
        $i++;
    }
    $_SESSION['tracks'] = $tracks;
    header('Location: search.php');
    closeCon($conn);
    exit();
?>
