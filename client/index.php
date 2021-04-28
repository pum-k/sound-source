<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./index.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <!-- CSS only -->
  <title>SoundSource</title>
</head>

<body>
  <div class="ctn-main">
    <div class="header">
      <div class="navbar">
        <p class="nav-title">SoundSource</p>
        <div>
          <button class="btn-outline">Sign In</button>
          <button class="btn">Create account</button>
        </div>
      </div>
      <div class="panel">
        <h2>Connect to SoundSource</h2>
        <p>
          Discover, stream, and share a constantly expanding mix of music from
          emerging and major artists around the world.
        </p>
        <button class="btn">Sign up now</button>
      </div>
    </div>
    <div class="form-search">
      <form >
        <input type="search" placeholder="Search for song" onkeyup="findSong(this.value)"/>
        <button type="submit" class="search-icon">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <span>or</span>
      <button class="btn btn-upload">Upload your own</button>
    </div>
    <p class="title">Hear what’s trending for free in the SoundSource</p>
    <div class="song-body">
    <?php
      require './List_music.php';
      ?>
    </div>
  </div>
  <div class="player">
    <audio controls class="song_audio">
      <source src="./static/audio/Rapitalove EP- Tay To - RPT MCK x RPT PhongKhin (Prod. by RPT PhongKhin) by Rapital.mp3" type="audio/ogg" />
    </audio>
    <div class="player-img"></div>
    <div class="player-info">
      <p>Buoc Qua Mua Co Don</p>
      <i style="color: #666;">Vu</i>
    </div>
  </div>
  <div style="margin-bottom: 100px;">
  </div>
  <script type="text/javascript">
    $('.song').hover(
      (e) => {
        var a = $(e.target).children(".song__play")

        a.css("opacity", "1");
      },
      (e) => {
        var a = $(e.target).children(".song__play")

        a.css("opacity", "0");
      }
    )

    function myFunction(id) {
      var target = id.children[1];
      var playerimage = document.getElementsByClassName('player-img')[0];
      var playerinfo = document.getElementsByClassName('player-info')[0];
      playerimage.style.backgroundImage = target.style.backgroundImage;
      playerinfo.children[0].textContent = id.children[2].textContent;
      playerinfo.children[1].textContent = id.children[3].textContent;

      var songaudio = document.getElementsByClassName('song_audio');
      // console.log(document.getElementsByClassName('song_audio')[0]);
      songaudio[0].children[0].src = id.children[4].textContent;
      document.getElementsByClassName('song_audio')[0].load();
      
    }

    function findSong(value) {
      console.log(value);
      if (value.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let value = JSON.parse(this.responseText);
            console.log(value);
          }
        };
        xmlhttp.open("GET", "gethint.php?value=" + value, true);
        xmlhttp.send();
      }
    }
  </script>
</body>

</html>