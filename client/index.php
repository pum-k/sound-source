<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./index.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap"
      rel="stylesheet"
    />
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
        <form action="">
          <input type="search" placeholder="Search for song" />
          <button type="submit" class="search-icon">
            <i class="fas fa-search"></i>
          </button>
        </form>
        <span>or</span>
        <button class="btn btn-upload">Upload your own</button>
      </div>
      <p class="title">Hear what’s trending for free in the SoundSource</p>
      <div class="song-body">
        <div class="song">
          <i class="fas fa-play play song__play"></i>
          <div class="song-img"></div>
          <p class="song-info">Buoc qua mua co don - toilavu</p>
          <p class="song-info">artist name</p>
        </div>
      </div>
    </div>

    <div class="player">
      <audio controls>
        <source
          src="./static/audio/Rapitalove EP- Tay To - RPT MCK x RPT PhongKhin (Prod. by RPT PhongKhin) by Rapital.mp3"
          type="audio/ogg"
        />
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
        (e)=>{
         var a =  $(e.target).children(".song__play")

          a.css("opacity","1");
        },
        (e)=>{
         var a =  $(e.target).children(".song__play")

          a.css("opacity","0");
        }
        
        
        )
    </script>
  </body>
</html>
