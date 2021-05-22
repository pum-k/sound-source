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
        <div id='user'>
          <button class="btn-outline nav-btn-75 hvr-bounce-to-top"><a href="./login.php" style="color: white">Sign In</a></button>
          <button class="btn nav-btn-115 hvr-pulse-grow">Create account</button>
        </div>
      </div>
      <div class="panel" id="panel">
      </div>
    </div>
    <div class="form-search">
      <!-- <form>
        <input placeholder="Search for song" class="input-search" onkeyup="findSong(this.value)" onkeydown="ChangePageSearch(event)"/>
        <div class="dropdown-search"  onclick="search()">
          <button class="getInfo">Search for: <span class="search_content"></span> </button>
        </div>
        <button type="submit" class="search-icon">
          <i class="fas fa-search"></i>
        </button>
      </form> -->
      <form>
        <input placeholder="Search for song and artist" class="input-search" name="search" onkeydown="ChangePageSearch(event)" />
        <!-- <div class="dropdown-search"  onclick="search()">
          <button class="getInfo">Search for: <span class="search_content"></span> </button>
        </div> -->
        <button type="submit" class="search-icon">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <span style="color: #999;">or</span>
      <button class="btn btn-upload hvr-pulse-grow" onclick="checkUserToUpdate()">Upload your own</button>
    </div>
    <p class="title">Hear what’s trending for free in the SoundSource</p>
    <div class="song-body">
      <?php
      $count = 1;
      $servername = "localhost";
      $username = "root";
      $password = "";
      $conn = new mysqli($servername, $username, $password);
      $conn->set_charset("utf8");
      $db = "sound-source";
      $conn->select_db($db);
      $statment = 'SELECT * FROM `baihat`';
      $result = mysqli_query($conn, $statment);
      while ($row = $result->fetch_assoc()) {
        echo '<button class="song" id="' . $row['baihat_id'] . '" onclick="myFunction(this)">';
        echo '<i class="fas fa-play play song__play"></i>';
        echo '<div class="song-img" style="background-image: url(' . $row['baihat_image'] . ');"></div>';
        echo '<p class="song-info">' . $row['baihat_ten'] . '</p>';
        echo '<p class="song-info">artist name</p>';
        echo '<p class="song-audio" hidden> ' . $row['baihat_url'] . '</p>';
        echo '</button>';
        $count++;
        if ($count >= 11) {
          break;  
        }
      }
      ?>
    </div>
    <div id="div_index">
      <ul id="index_music">
        <li value="1" onclick="changePage(this.value)">1</li>
        <li value="2" onclick="changePage(this.value)">2</li>
        <li value="3" onclick="changePage(this.value)">3</li>
      </ul>
    </div>
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
  <div style="margin-bottom: 100px;">
  </div>
  <script src="./handleUser.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript">
    function changePage(index) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange =  function() {
        if (this.readyState == 4 && this.status == 200) {
         let value =  JSON.parse(this.responseText);
          var song_body = document.getElementsByClassName('song-body')[0];
          song_body.innerHTML = '';
          let song;
          value.map(item => {
            console.log(item);
            song = `<button class="song" id="2" onclick="myFunction(this)">
            <i class="fas fa-play play song__play" aria-hidden="true">
            </i><div class="song-img" style="background-image: url(${item['baihat_image']});">
            </div><p class="song-info">${item["baihat_ten"]}</p><p class="song-info">artist name</p><p class="song-audio" hidden=""> ${item['baihat_url']}</p>
            </button>`
            song_body.innerHTML+=song;
          })
        }
      }
      xmlhttp.open("GET", "List_music.php?page=" + index, true);
      xmlhttp.send();
    }
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

    function ChangePageSearch(event) {
      // 
      let input = document.getElementsByClassName('input-search')[0];
      if (event.keyCode == 13) {
        event.preventDefault();
        console.log('hello');
        window.location.replace('http://localhost/sound-source/client/search.php?value=' + input.value);
      }
    }

    function findSong(value) {
      var searchItem = document.getElementsByClassName('getInfo')[0];
      var Option = document.getElementsByClassName("Option");
      let buttonDropdown = document.getElementsByClassName('dropdown-search')[0];
      if (value != "") {
        document.getElementsByClassName('getInfo')[0].children[0].innerHTML = value;

        while (document.getElementsByClassName('dropdown-search')[0].length > 1) {
          document.getElementsByClassName('dropdown-search')[0].removeChild(myNode.lastElementChild);
        }
      }
      if (value.length == 0) {
        buttonDropdown.innerHTML = '';
        buttonDropdown.innerHTML = '<button class="getInfo">Search for: <span class="search_content"></span> </button>';
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = async function() {
          if (this.readyState == 4 && this.status == 200) {
            let value = JSON.parse(this.responseText);
            if (value.length > 0) {
             
              while (Option.length > 0) {
                Option.removeChild(myNode.lastElementChild);
              }
              let button = document.createElement('button')
              button.setAttribute('onClick', 'search()')
              button.className = "Option";
              button.innerHTML = " <i class='fas fa-search' style='margin-right: 15px;'>  </i> " + value;
              buttonDropdown.appendChild(button);
            }
          }
        };
        xmlhttp.open("GET", "gethint.php?value=" + value, true);
        xmlhttp.send();
      }
    }
    loadUser('user', true);

    const checkLogin = () => {
      const panel = document.getElementById('panel');
      if (sessionStorage.getItem("username") === null) {
        panel.innerHTML = `<h2>Connect to SoundSource</h2>
        <p>
          Discover, stream, and share a constantly expanding mix of music from
          emerging and major artists around the world.
        </p>
        <button class="btn hvr-pulse-grow"><a href="./login.php">Sign in now</a></button>`;
      } else {
        panel.innerHTML = `<h2>Connect to SoundSource</h2>
        <p>
          Discover, stream, and share a constantly expanding mix of music from
          emerging and major artists around the world.
        </p>`;
      }
    }
    checkLogin();
    const checkUserToUpdate = () => {
      if (sessionStorage.getItem('username')) {
        window.location.replace('upload.php');
      } else {
        window.location.replace('http://localhost/sound-source/client/login.php');
      }
    }
  </script>
</body>

</html>