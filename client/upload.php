<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="./navbar.css" type="text/css" />
    <link rel="stylesheet" href="./upload.css" type="text/css" />
  </head>
  <body>

    //? Navbar
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
          <input type="search" />
          <i class="fas fa-search"></i>
        </div>
        <div class="item-user" id="user">
          <button>Log in</button>
        </div>
      </div>
    </div>
    //? Content
    <div class="ctn-main">
    <h2 class="main-title">Basic Information</h2>
      <div class="ctn-info">
            <div class="left">
              <div class="photo" id="photo" >
                <button class="upload-photo" onclick="uploadPhoto()">
                <i class="fas fa-camera"></i>
                  Upload your photo
                </button>
                <input id="fileUpload" style="display: none" type="file">
              </div>
            </div>

            <div class="right">
              <label for="uploadFile">Upload file:</label>
              <input type="file">
              <label for="title">Title:</label>
              <input type="text" name="title" placeholder="Name your track"/>

              <div style="display: flex; justify-content:space-between">
                <div>
                <label for="genre">Genre:</label>
                <select name="genre" id="genre" class="genre">
                  <option value="">None</option>
                  <option value="rock">Rock</option>
                  <option value="ballad">Ballad</option>
                  <option value="danceNEdm">Dance&Edm</option>
                  <option value="indie">Indie</option>
                  <option value="pop">Pop</option>
                  <option value="rap">Rap</option>
                  <option value="bolero">Bolero</option>
                  <option value="audioBooks">Audio books</option>
                  <option value="custom">Other...</option>
                </select>
                </div>
              </div>
              
              <label for="description">Description: </label>
              <textarea name="description" id="description" rows="10" class="description" placeholder="Describe your track" ></textarea>
              
              <label for="privacy">Privacy: </label>
              <div>
                <input type="radio" value="public" name="privacy">Public</input>
                <i style="display: block; margin-left: 10px; font-size: 12px; color: #757575;">Anyone will be able to listen to this track</i>
              </div>
              <div>
                <input type="radio" value="private" name="privacy">Private</input>
                <i style="display: block; margin-left: 10px; font-size: 12px; color: #757575;">Only you and people you share a secret link with will be able to listen to this track</i>
              </div>
              <div class="footer">
                <button class="btn btn-cancel">Cancel</button>
                <button class="btn btn-save">Save</button>
              </div>
            </div>
      </div>
    </div>
  </body>
  <script src="./upload.js"></script>
  <script src="./handleUser.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    const notLoggedIn =  "window.location = 'http://localhost/sound-source/client/login.php'";
    loadUser("user",`<button onclick="${notLoggedIn}">Login</button>`);
    if(!sessionStorage.getItem('username')){
      window.location.replace('http://localhost/sound-source/client/index.php');
    }
  </script>
</html>

