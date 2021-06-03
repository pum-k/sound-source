<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./navbar.css" />
  <link rel="stylesheet" href="./search.css" />
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search</title>
</head>

<body>
  <div class="navbar">
    <div class="nav-content">
      <div class="title">
        <a href="./index.php">SoundSource</a>
      </div>
      <div class="item">
        <a href="./index.php">Home</a>
      </div>
      <div class="item">
        <a href="upload.php">Upload</a>
      </div>
      <div class="item item-search">
        <input type="search" class="search_Song" onkeydown="searchSong(event)" />
        <i class="fas fa-search"></i>
      </div>
      <div class="item-user" id="user">
      </div>
    </div>
  </div>

  <div class="ctn-main" style="margin-bottom: 150px;">
    <div class="value">
      <h2>Search results for
        <?php
        if (isset($_REQUEST['value'])) {
          echo '<span class="found-results" value="' . $_REQUEST['value'] . '">' . $_REQUEST["value"] . '</span>';
        }
        ?>
      </h2>
    </div>
    <div class="results">
      <div class="type">
        <ul>
          <li>
            <button class="btn-type active">
              <i class="fas fa-search"></i> Everything
            </button>
            <div class="triangle-right"></div>
          </li>
        </ul>
      </div>
      <div class="search-item">
        <i class="total-search">
          <div class="found-peoples" style="display:inline">
            Found 500+ people,
          </div>
          <div class="found-tracks" style="display:inline">
            500+ tracks
          </div>
        </i>
        <div class="ctn-search-item" id="renderPeople">
          <?php
          require './connection.php';
          $countPeople = 0;
          $conn = openCon();
          mysqli_set_charset($conn, 'utf8');
          if (isset($_REQUEST['value'])) {
            $value = '%' . $_REQUEST['value'] . '%';
            $query = "select * from `tacgia` WHERE tacgia_ten LIKE '" . $value . "'";
            $people = mysqli_query($conn, $query);
            while ($row = $people->fetch_assoc()) {
              echo  "<div class='people' onclick='changePageToProfile(this.lastElementChild)'>";
              echo  "<div class='avatar' style='background-image: url(" . $row['tacgia_image'] . ")'></div>";
              echo   "<div class='info'>";
              echo   " <p class='people-name'>" . $row['tacgia_ten'] . "</p>";
              echo   "<i>10 tracks</i>";
              echo   "</div>";
              echo "</div>";
              $countPeople++;
              if ($countPeople >= 5) {
                break;
              }
            }
          }
          ?>
        </div>
        <div id="div_index_People">
          <?php
          echo '<ul id="index_people_music">';
          $numrows =  mysqli_num_rows($people);
          $countpeople = 0;
          while ($numrows > 5) {
            $numrows -= 5;
            $countpeople++;
          }
          if ($numrows > 0) {
            $countpeople++;
          }
          if ($countpeople > 1) {
            for ($x = 1; $x <=  $countpeople; $x++) {
              echo '<li value=' . $x . ' onclick="changePagePeople(event)">' . $x . '</li>';
            }
          }
          echo '</ul>'
          ?>
        </div>
        <div class="ctn-search-item" id="renderSong">
          <?php
          $newCount = 0;
          if (isset($_REQUEST['value'])) {
            $query = "select baihat_ten,baihat_url,baihat_image, tacgia_ten FROM baihat as b inner join tacgia as t WHERE b.baihat_ten like '$value' and b.tacgia_id = t.tacgia_id";
            $song = mysqli_query($conn, $query);
            while ($row = $song->fetch_assoc()) {
              echo "<div class='song' onclick='playsong(this)' value='" . $row['baihat_ten'] . "'>";
              echo   "<div class='avatar' style='background-image: url(" . $row['baihat_image'] . ")' value='" . $row['baihat_ten'] . "'></div>";
              echo  "<div class='info'>";
              echo  " <p value='" . $row['baihat_ten'] . "'>" . $row['baihat_ten'] . "</p>";
              echo   "<p class='artist'>" . $row['tacgia_ten'] . "</p>";
              echo " </div>";
              echo "<div class='valuebaihat' hidden=true>" . $row['baihat_url'] . " </div>";
              echo "<div class='urlbaihat' hidden=true>" . $row['baihat_image'] . " </div>";
              echo "</div>";
              $newCount++;
              if ($newCount >= 5) {
                break;
              }
            }
          }
          ?>
        </div>
        <div id="div_index_Song">
          <?php
          echo '<ul id="index_song_music">';
          $numrows =  mysqli_num_rows($song);
          $countsong = 0;

          while ($numrows > 5) {
            $numrows -= 5;
            $countsong++;
          }
          if ($numrows > 0) {
            $countsong++;
          }
          // echo $countpeople;
          if ($countsong > 1) {
            for ($x = 1; $x <=  $countsong; $x++) {
              echo '<li value=' . $x . ' onclick="changePageSong(event)">' . $x . '</li>';
            }
          }
          echo '</ul>'
          ?>
        </div>
      </div>
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
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script src="./handleUser.js"></script>
<script>
  function changePageToProfile(e){
    // console.log(e.firstElementChild.textContent);
    let target = e.firstElementChild.textContent
    window.location.replace('http://localhost/sound-source/client/profile-permission.php?value=' + target);
  }

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

  function searchSong(event) {
    var song = document.getElementsByClassName('search_Song')[0];
    if (event.keyCode == 13) {
      value = song.value;
      let find_what = document.getElementsByClassName('found-results')[0].innerHTML = value;
      document.getElementsByClassName('found-results').value = value
      renderSongInfo(value);
      renderPeopleInfo(value);
    }
  }

  function renderPeopleInfo(value) {
    let renderPeople = document.getElementById('renderPeople');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {
        let value = JSON.parse(this.responseText);
        console.log(value);
        let found_tracks = document.getElementsByClassName('found-peoples')[0].innerHTML = 'Found ' + value.length + ' People, ';
        if (value.length > 0) {
          renderPeople.innerHTML = '';
          let htmlRender;
          value.forEach((item, index) => {
            if (index < 5) {
              htmlRender = `
            <div class='people' onclick="changePageToProfile(this.lastElementChild)">
                <div class='avatar' style="background-image: url('${item[2]}')"></div>
                <div class="info">
                  <p class='people-name'>${item[1]}</p>
                 <i>10 tracks</i>
                </div>
              </div>
            `;
              renderPeople.innerHTML += htmlRender;
            }
          })
          // render lai index phan trang
          let indexsearch = document.getElementById('index_people_music');
          let length = value.length;
          let html = '';
          indexsearch.innerHTML = '';
          let count = 0;
          while (length > 5) {
            length -= 5;
            count++;
          }
          if (length > 0) {
            count++;
          }

          for (var i = 1; i <= count; i++) {
            html += '<li value=' + i + ' onclick="changePagePeople(event)">' + i + '</li>';
          }
          indexsearch.innerHTML = html;
        } else {
          renderPeople.innerHTML = 'không tìm thấy người dùng nào';
        }
      }
    };
    xmlhttp.open("GET", "searchpeople.php?value=" + value, true);
    xmlhttp.send();
  }

  function renderSongInfo(value) {
    var xmlhttp = new XMLHttpRequest();
    let renderSong = document.getElementById('renderSong');
    xmlhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {
        let value = JSON.parse(this.responseText);
        console.log(value.length);
        let found_tracks = document.getElementsByClassName('found-tracks')[0].innerHTML = 'Found ' + value.length + ' Tracks';
        if (value.length > 0) {
          renderSong.innerHTML = '';
          let htmlRender;
          value.forEach((item, index) => {
            if (index < 5) {
              htmlRender = `
                <div class='song' onclick='playsong(this)'>
                  <div class='avatar' style="background-image: url('${item[2]}')"></div>
                  <div class="info">
                    <p>${item[0]}</p>
                    <p class='artist'>${item[3]}</p>
                  </div>
                  <div class='valuebaihat' hidden=true>${item[1]}</div>
                  <div class='urlbaihat' hidden=true>${item[2]}</div>
                </div>
              `;
              renderSong.innerHTML += htmlRender;
            }
          })
          let indexsearch = document.getElementById('index_song_music');
          let length = value.length;
          let html = '';
          indexsearch.innerHTML = '';
          let count = 0;
          while (length > 5) {
            length -= 5;
            count++;
          }
          if (length > 0) {
            count++;
          }
          for (var i = 1; i <= count; i++) {
            html += '<li value=' + i + ' onclick="changePageSong(event)">' + i + '</li>';
          }
          indexsearch.innerHTML = html;
        } else {
          renderSong.innerHTML = 'không có bài hát nào được tìm thấy';
        }
      }
    };
    xmlhttp.open("GET", "searchSong.php?value=" + value, true);
    xmlhttp.send();
  }

  function changePageSong(e) {
    let value = document.getElementsByClassName('found-results')[0].textContent;
    console.log(value);
    let renderSong = document.getElementById('renderSong');
    let start = (+e.target.value - 1) * 5;
    let end = (+e.target.value) * 5
    if (value != undefined) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = async function() {
        if (this.readyState == 4 && this.status == 200) {
          let result = JSON.parse(this.responseText);
          console.log(result);
          if (start < result.length) {
            renderSong.innerHTML = '';
            let htmlRender;
            result.forEach((item, index) => {
              if (start < index && index <= end) {
                htmlRender = `
                <div class='song' onclick='playsong(this)'>
                  <div class='avatar' style="background-image: url('${item[2]}')"></div>
                  <div class="info">
                    <p>${item[0]}</p>
                    <p class='artist'>${item[3]}</p>
                  </div>
                  <div class='valuebaihat' hidden=true>${item[1]}</div>
                  <div class='urlbaihat' hidden=true>${item[2]}</div>
                </div>
              `;
                renderSong.innerHTML += htmlRender;
              }
            })
          } else {
            renderSong.innerHTML = 'không có bài hát nào được tìm thấy';
          }
        }
      }
    }
    xmlhttp.open("GET", "searchSong.php?value=" + value, true);
    xmlhttp.send();
  }

  function changePagePeople(e) {
    let value = document.getElementsByClassName('found-results')[0].textContent;
    let renderSong = document.getElementById('renderPeople');
    let start = (+e.target.value - 1) * 5;
    let end = (+e.target.value) * 5
    if (value != undefined) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = async function() {
        if (this.readyState == 4 && this.status == 200) {
          let result = JSON.parse(this.responseText);
          if (start < result.length) {
            renderSong.innerHTML = '';
            let htmlRender;
            result.forEach((item, index) => {
              if (start < index && index <= end) {
                htmlRender = `
            <div class='people'>
                <div class='avatar' style="background-image: url('${item[2]}')"></div>
                <div class="info">
                  <p class='people-name'>${item[1]}</p>
                 <i>10 tracks</i>
                </div>
              </div>
            `;
                renderSong.innerHTML += htmlRender;
              }
            })
          } else {
            renderSong.innerHTML = 'không có ca sĩ nào được tìm thấy';
          }
        }
      }
    }
    xmlhttp.open("GET", "searchpeople.php?value=" + value, true);
    xmlhttp.send();
  }
  const notLoggedIn = "window.location = 'http://localhost/sound-source/client/login.php'";

  loadUser("user", true);
</script>

</html>