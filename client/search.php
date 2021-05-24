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

  <div class="ctn-main">
    <div class="value">
      <h2>Search results for
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
          <?php
          require './connection.php';
          $conn = openCon();
          mysqli_set_charset($conn, 'utf8');
          if (isset($_REQUEST['value'])) {
            $value = '%' . $_REQUEST['value'] . '%';
            $query = "select * from `tacgia` WHERE tacgia_ten LIKE '" . $value . "'";
            $result = mysqli_query($conn, $query);
            while ($row = $result->fetch_assoc()) {
              echo  "<div class='people'>";
              echo  "<div class='avatar' style='background-image: url(" . $row['tacgia_image'] . ")'></div>";
              echo   "<div class='info'>";
              echo   " <p class='people-name'>" . $row['tacgia_ten'] . "</p>";
              echo   "<i>10 tracks</i>";
              echo   "</div>";
              echo "</div>";
            }
          }
          ?>
        </div>
        <div class="ctn-search-item" id="renderSong">
          <?php
          $query = "select baihat_ten,baihat_url,baihat_image, tacgia_ten FROM baihat as b inner join tacgia as t WHERE b.baihat_ten like '$value' and b.tacgia_id = t.tacgia_id";
          $result = mysqli_query($conn, $query);
          while ($row = $result->fetch_assoc()) {
            echo "<div class='song'>";
            echo   "<div class='avatar' style='background-image: url(" . $row['baihat_image'] . ")'></div>";
            echo  "<div class='info'>";
            echo  " <p>" . $row['baihat_ten'] . "</p>";
            echo   "<p class='artist'>" . $row['tacgia_ten'] . "</p>";
            echo " </div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script src="./handleUser.js"></script>
<script>
  function searchSong(event) {
    var song = document.getElementsByClassName('search_Song')[0];
    if (event.keyCode == 13) {
      value = song.value;
      renderSongInfo(value);
      renderPeopleInfo(value);
    }
  }

  function renderPeopleInfo(value) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {
        let value = JSON.parse(this.responseText);
        // console.log(value);
        if (value.length > 0) {
          let renderPeople = document.getElementById('renderPeople');
          renderPeople.innerHTML = '';
          let htmlRender;
          value.forEach(item => {
            htmlRender = `
            <div class='people'>
                <div class='avatar' style="background-image: url('${item[2]}')"></div>
                <div class="info">
                  <p class='people-name'>${item[1]}</p>
                 <i>10 tracks</i>
                </div>
              </div>
              `;
            renderPeople.innerHTML += htmlRender;
          })
        }
      }
    };
    xmlhttp.open("GET", "searchpeople.php?value=" + value, true);
    xmlhttp.send();
  }

  function renderSongInfo(value) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {
        let value = JSON.parse(this.responseText);
        if (value.length > 0) {
          let renderSong = document.getElementById('renderSong');
          renderSong.innerHTML = '';
          let htmlRender;
          value.forEach(item => {
            htmlRender = `
                <div class='song'>
                  <div class='avatar' style="background-image: url('${item[2]}')"></div>
                  <div class="info">
                    <p>${item[0]}</p>
                    <p class='artist'>${item[3]}</p>
                  </div>
                </div>
              `;
            renderSong.innerHTML += htmlRender;
          })
        }
      }
    };
    xmlhttp.open("GET", "searchSong.php?value=" + value, true);
    xmlhttp.send();
  }

  loadUser("user", true);
</script>

</html>