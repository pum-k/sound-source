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
          <input type="search" />
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
          <div class="ctn-search-item">
            <!-- This for rendering -->
            <div class="people">
              <div class="avatar"></div>
              <div class="info">
                <p class="people-name">Kessha</p>
                <i>10 tracks</i>
              </div>
            </div>
            <div class="people">
              <div class="avatar"></div>
              <div class="info">
                <p class="people-name">Kessha</p>
                <i>10 tracks</i>
              </div>
            </div>
            <div class="people">
              <div class="avatar"></div>
              <div class="info">
                <p class="people-name">Kessha</p>
                <i>10 tracks</i>
              </div>
            </div>
             <!-- This for rendering people -->
          </div>
          <div class="ctn-search-item">
            <!-- This for rendering -->
            <div class="song">
              <div class="avatar"></div>
              <div class="info">
                <p class="artist">Kessha</p>
                <p>Can we love?</p>
              </div>
            </div>
            <div class="song">
              <div class="avatar"></div>
              <div class="info">
                <p class="artist">Kessha</p>
                <p>Can we love?</p>
              </div>
            </div>
            <div class="song">
              <div class="avatar"></div>
              <div class="info">
                <p class="artist">Kessha</p>
                <p>Can we love?</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script
    src="https://kit.fontawesome.com/3e954ec838.js"
    crossorigin="anonymous"
  ></script>
  <script>
    

  </script>
</html>
