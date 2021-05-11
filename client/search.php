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
        <a href="upload.php">Upload</a>
      </div>
      <div class="item item-search">
        <input type="search" class="search_Song"/>
        <i class="fas fa-search"></i>
      </div>
    </div>
  </div>

  <div class="ctn-main">
    <div class="value">
      <h2>Search results for <?php session_start(); echo $_SESSION['search']; ?></h2>
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
        </div>
        <div class="ctn-search-item" id="renderSong">
        </div>
      </div>
    </div>
  </div>
</body>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
		
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script>
  let getSessionTracks = <?php
    session_start();
    echo json_encode($_SESSION["tracks"], JSON_HEX_TAG);
  ?>;

  //get tracks
  const tracks = [];
  let getTracks = getSessionTracks[0];
  for(let i = 0; i < getTracks.length; i++){
    tracks.push({"name": getTracks[i][0],"url": getTracks[i][1],"image" : getTracks[i][2], "artist": getTracks[i][3]});
  };
  //get artist

  //render tracks
  const renderPeople = document.getElementById('renderSong');
  console.log(renderPeople);
  let htmlRender;
  tracks.forEach((track) => {
    htmlRender = `
      <div class='song'>
        <div class='avatar' style="background-image: url('${track['image']}')"></div>
        <div class="info">
          <p>${track['name']}</p>
          <p class='artist'>${track['artist']}</p>
        </div>
      </div>
    `;

    //render artist
    // <div class='people'>
    //     <div class='avatar' style="background-image: url('${track['image']}')"></div>
    //     <div class="info">
    //       <p>${track['name']}</p>
    //       <p class='people-name'>${track['artist']}</p>
              // <i>10 tracks</i>
    //     </div>
    //   </div>

    
    console.log(htmlRender);
    renderPeople.innerHTML += htmlRender;
  });
  
  const notLoggedIn = "window.location = 'http://localhost/sound-source/client/login.php'";
  loadUser("user", `<button onclick="${notLoggedIn}">Login</button>`);
</script>
</html>