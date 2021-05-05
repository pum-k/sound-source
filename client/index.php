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
  <!-- CSS only -->
  <title>SoundSource</title>
</head>

<body>
  <div class="ctn-main">
    <div class="header">
      <div class="navbar">
        <p class="nav-title">SoundSource</p>
        <div>
          <button class="btn-outline nav-btn-75 hvr-bounce-to-top"><a href="./login.html">Sign Inb</a></button>
          <button class="btn nav-btn-115 hvr-pulse-grow">Create account</button>
        </div>
      </div>
      <div class="panel">
        <h2>Connect to SoundSource</h2>
        <p>
          Discover, stream, and share a constantly expanding mix of music from
          emerging and major artists around the world.
        </p>
        <button class="btn hvr-pulse-grow"><a href="./login.html">Sign up now</a></button>
      </div>
    </div>
    <div class="form-search">
      <form>
        <input type="search" placeholder="Search for song" class="input-search" onkeyup="findSong(this.value)" />
        <div class="dropdown-search">
          <button class="getInfo">Search for: <span class="search_content"></span> </button>

        </div>
        <button type="submit" class="search-icon">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <span style="color: #999;">or</span>
      <button class="btn btn-upload hvr-pulse-grow">Upload your own</button>
    </div>
    <p class="title">Hear what’s trending for free in the SoundSource</p>
    <div class="song-body">
      <?php
      require './List_music.php';
      ?>
    </div>
  </div>
  <div class="player">
    <audio controls class="song_audio" autoplay>
      <source src="./static/audio/Rapitalove EP- Tay To - RPT MCK x RPT PhongKhin (Prod. by RPT PhongKhin) by Rapital.mp3" type="audio/mp3" />
    </audio>
    <div class="player-img"></div>
    <div class="player-info">
      <p>Tay To </p>
      <i style="color: #666;">Vu</i>
    </div>
  </div>
  <div style="margin-bottom: 100px;">
  </div>
  <?php

  ?>
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
      songaudio[0].children[0].src = id.children[4].textContent;
      document.getElementsByClassName('song_audio')[0].load();
    }
    function takeSong (){
      console.log('hello');
    }


    function findSong(value) {
      var searchItem = document.getElementsByClassName('getInfo')[0];
      if (value != "") {
        document.getElementsByClassName('getInfo')[0].children[0].innerHTML = value;
      }
      if (value.length == 0) {
        var Option = document.getElementsByClassName("Option");
        buttonDropdown.innerHTML = '';
        buttonDropdown.innerHTML = '<button class="getInfo">Search for: <span class="search_content"></span> </button>';
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = async function() {
          if (this.readyState == 4 && this.status == 200) {
            let value = JSON.parse(this.responseText);
            let buttonDropdown = document.getElementsByClassName('dropdown-search')[0];
            if (value.length > 0) {
              var Option = document.getElementsByClassName("Option");
              console.log(Option);
             
              let button = document.createElement('button')
              button.className = "Option";
              button.setAttribute('onclick', "takeSong()")
           
              button.innerHTML = " <i class='fas fa-search' style='margin-right: 15px;'>  </i> " + value;
              buttonDropdown.appendChild(button);
            }
          }
        };
        xmlhttp.open("GET", "gethint.php?value=" + value, true);
        xmlhttp.send();
      }
    }
  </script>
</body>

</html>