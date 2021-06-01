<?php
require './connection.php';
$conn = openCon();
mysqli_set_charset($conn, 'utf8');
if (isset($_REQUEST['value'])) {
    $query = "select * from `tacgia` WHERE tacgia_ten = '" . $_REQUEST['value'] . "'";
    $people = mysqli_query($conn, $query);
    $array = mysqli_fetch_array($people);
    // echo $query;
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./navbar.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundSource</title>
    <link rel="stylesheet" href="./profile-permission.css" />
</head>

<body>
    <div class="navbar">
        <div class="nav-content">
            <div class="direct">
                <div class="title">
                    <a href="./index.php">SoundSource</a>
                </div>
                <div class="item">
                    <a href="./index.php">Home</a>
                </div>
                <div class="item">
                    <a href="upload.php">Upload</a>
                </div>
            </div>
            <div class="item item-search">
                <input type="search" class="search_Song" onkeydown="ChangePageSearch(event)" />
                <i class="fas fa-search"></i>
            </div>
            <div class="item-user" id="user">
            </div>
        </div>
    </div>

    <div class="ctn-main">
        <div class="profile-header">
            <img class="avatar" src="<?php echo $array['img'] ?>"></img>
            <div class="name">
                <h1><?php echo $array['tacgia_ten'] ?></h1>
                <p><?php echo $array['bio'] ?></p>
            </div>
        </div>

        <div class="title-track">
            <h1>Tracks</h1>
        </div>

        <div class="owner-tracks">
            <?php
            $conn = openCon();
            $newQuery = 'Select * from `baihat` where tacgia_id =' . $array['tacgia_id'] . '';
            $result = mysqli_query($conn, $newQuery);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='track' onclick='playsong(this)'>";
                    echo "<div class='image' style='background-image: url(" . $row['baihat_image'] . ")'>";
                    echo "</div>";
                    echo "<h3> " . $row['baihat_ten'] . "</h3>";
                    echo "<div class='valuebaihat' hidden=true>" . $row['baihat_url'] . " </div>";
                    echo "<div class='urlbaihat' hidden=true>" . $row['baihat_image'] . " </div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="modal-edit-profile" id="modal">
        <form class="modal-content" action="./handle-edit-user.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <table style="width: 100%;">
                    <tr>
                        <th class="left">
                            <img src="" class='avatar' id="avatar">
                            <input id="uploadNewAvatar" type="file" name="image" accept="image/*">
                        </th>
                        <th class="right">
                            <label>Display name<font color="red">*</font>:</label>
                            <input type="text" name="displayName" id="displayName" value="" required minLength="5">
                            <label>Bio:</label>
                            <textarea name="bio" id="bio" maxlength="150" placeholder="Your bio here... (less than 150 characters)"></textarea>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div class="modal-control">
                    <button type="submit">Save</button>
                    <p type="cancel" onclick="closeModal()">Cancel</p>
                </div>
            </div>
        </form>
    </div>
    <div class="player">
  <audio controls class="song_audio" autoplay>
    <source src="./static/audio/Rapitalove EP- Tay To - RPT MCK x RPT PhongKhin (Prod. by RPT PhongKhin) by Rapital.mp3" type="audio/mp3" />
  </audio>
  <div class="player-img"></div>
  <div class="player-info">
    <p>Tay To </p>
    <i style="color: #ddd;">Vu</i>
  </div>
</div>
</body>
<script>
    function playsong(e) {
    var playerimage = document.getElementsByClassName('player-img')[0];
    var playerinfo = document.getElementsByClassName('player-info')[0];
    playerimage.style.backgroundImage = "url(" + e.children[3].textContent + ")";
    playerinfo.children[0].textContent = e.children[0].textContent;
    playerinfo.children[1].textContent = e.children[1].textContent;
    var songaudio = document.getElementsByClassName('song_audio');
    songaudio[0].children[0].src = e.children[2].textContent;
    document.getElementsByClassName('song_audio')[0].load();
  }


</script>
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script src="./handleUser.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>