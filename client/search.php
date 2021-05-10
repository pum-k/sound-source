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
        <a href="#">Library</a>
      </div>
      <div class="item">
        <a href="upload.html">Upload</a>
      </div>
      <div class="item item-search">
        <input type="search" class="search_Song" value="" onkeydown="searchSong(event)" />
        <i class="fas fa-search"></i>
      </div>
    </div>
  </div>

  <div class="ctn-main">
    <div class="value">
      <h2>Search results for "keyword"</h2>
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
          <li>
            <button class="btn-type">
              <i class="fas fa-user-friends"></i> People
            </button>
            <div class="triangle-right"></div>
          </li>
          <li>
            <button class="btn-type">
              <i class="fas fa-music"></i> Tracks
            </button>
            <div class="triangle-right"></div>
          </li>
        </ul>
      </div>
      <div class="search-item">
        <i class="total-search">Found 500+ people, 500+ tracks</i>
        <div class="ctn-search-item" id="renderPeople">
          <!-- This for rendering -->
          <?php
          $servername =  "localhost";
          $username =   "root";
          $password =   "";
          $conn = @new mysqli($servername, $username, $password, "sound-source");
          mysqli_set_charset($conn, 'utf8');
          if (isset($_REQUEST['value'])) {
            $value = $_REQUEST['value'];
            $query = "SELECT * ,tacgia_ten FROM baihat INNER JOIN tacgia ON tacgia.tacgia_id = baihat.tacgia_id where MATCH(baihat_ten) AGAINST( '%$value%' )";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_row($result)) {
              echo  '<div class="people">';
              echo  '<div class="avatar" style="background-image: url(' .$row['4']. ')"></div>';
              echo  '<div class="info">';
              echo    '<p class="people-name">' . $row['1'] . '</p>';
              echo  ' <i>10 tracks</i>';
              echo  '</div>';
              echo '</div>';
            }
          }
          ?>
        </div>
        <div class="ctn-search-item" id="renderSong">
        <?php
          $servername =  "localhost";
          $username =   "root";
          $password =   "";
          $conn = @new mysqli($servername, $username, $password, "sound-source");
          mysqli_set_charset($conn, 'utf8');
          if (isset($_REQUEST['value'])) {
            $value = $_REQUEST['value'];
            $query = "SELECT * ,tacgia_ten FROM baihat INNER JOIN tacgia ON tacgia.tacgia_id = baihat.tacgia_id where MATCH(baihat_ten) AGAINST( '%$value%' )";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_row($result)) {
              echo   '<div class="song">';
              echo '<div class="avatar"></div>';
              echo '<div class="info">';
              echo  '<p class="artist">' .$row[7]. '</p>';
              echo  '<p>' .$row[1]. ' </p>';
              echo '</div>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
// if (isset($_REQUEST['value'])) {
//   echo ` <script> renderPeople(` .$_REQUEST['value'].`)</script>`;
// }
?>
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script>
  function searchSong(event) {
    var song = document.getElementsByClassName('search_Song')[0];
    if (event.keyCode == 13) {
      value = song.value;
      renderPeople(value);
    }
  }

  function renderPeople(value) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {
        let value = JSON.parse(this.responseText);
        if (value.length > 0) {
          console.log(value[0]);
          let renderSong = document.getElementById('renderSong');
          renderSong.innerHTML = `
              <div class="song">
              <div class="avatar"></div>
              <div class="info">
                <p class="artist">` + value[0][7] + `</p>
                <p>` + value[0][1] + `</p>
              </div>
              </div>
              
              `;
          let renderPeople = document.getElementById('renderPeople');
          renderPeople.innerHTML = `
              <div class="people">
              <div class="avatar" style="background-image: url(` + value[0][4] + `)"></div>
              <div class="info">
                <p class="people-name">` + value[0][1] + `</p>
                <i>` + value[0][5] + `</i>
              </div>
            </div>
              `;
        }
      }
    };
    xmlhttp.open("GET", "searchSong.php?value=" + value, true);
    xmlhttp.send();
  }
</script>

</html>