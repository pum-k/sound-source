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
        <input type="search" class="search_Song" onkeydown="ChangePageSearch(event)" />
        <i class="fas fa-search"></i>
      </div>
      <div class="item-user" id="user">

      </div>
    </div>
  </div>
  <div class="ctn-main">
    <h2 class="main-title">Basic Information</h2>
    <form class="ctn-info" action="handle-upload.php" enctype="multipart/form-data" method="POST">
      <div class="left">
        <img class="photo" id="photo" src="#">
        </img>
        <input required name="image" id="image" type="file" accept="image/*" />
      </div>
      <div class="right">
        <label for="track">Upload file:</label>
        <input required type="file" name="audio">
        <label for="title">Title:</label>
        <input required type="text" name="title" placeholder="Name your track" />
        <div style="display: flex; justify-content:space-between">
          <div>
            <label for="genre">Genre:</label>
            <select name="genre" id="genre" class="genre">
              <option value="">Genre</option>
              <option value="rock">Rock</option>
              <option value="ballad">Ballad</option>
              <option value="danceNEdm">Dance&Edm</option>
              <option value="indie">Indie</option>
              <option value="pop">Pop</option>
              <option value="rap">Rap</option>
              <option value="bolero">Bolero</option>
              <option value="audioBooks">Audio books</option>
              <option value="other">Other...</option>
            </select>
          </div>
        </div>
        <label for="description">Description: </label>
        <textarea name="description" id="description" rows="10" class="description" placeholder="Describe your track"></textarea>

        <label for="privacy">Privacy: </label>
        <div>
          <input required type="radio" value="1" name="privacy">Public</input>
          <i style="display: block; margin-left: 10px; font-size: 12px; color: #757575;">Anyone will be able to listen to this track</i>
        </div>
        <div>
          <input required type="radio" value="0" name="privacy">Private</input>
          <i style="display: block; margin-left: 10px; font-size: 12px; color: #757575;">Only you and people you share a secret link with will be able to listen to this track</i>
        </div>
        <div class="footer">
          <button class="btn btn-cancel">Cancel</button>
          <button type="submit" class="btn btn-save" onclick="submit()">Save</button>
        </div>
      </div>
    </form>
  </div>
</body>
<script src="./handleUser.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./Notification.js"></script>
<script src="./handle-session-validate.js"></script>
<script>
  loadUser("user", false);

  const inputImg = document.getElementById("image");
  inputImg.onchange = event => {
    const [file] = inputImg['files'];
    if (file) {
      document.getElementById("photo").src = URL.createObjectURL(file);
    }
  }

  if (!sessionStorage.getItem('username')) {
    window.location.replace('http://localhost/sound-source/client/index.php');
  }

  function ChangePageSearch(event) {
    let input = document.getElementsByClassName('search_Song')[0];
    if (event.keyCode == 13) {
      event.preventDefault();
      window.location.replace('http://localhost/sound-source/client/search.php?value=' + input.value);
    }
  }
  // check success >>> 
  let validate = getValidate('upload');
  if (validate) {
    notification('success', 'Update your profile successfully');
    deleteValidate('upload');
  }

  if (validate === false) {
    notification('error', 'Fail to update your profile, please try again!');
    deleteValidate('upload');
  }
  // <<<
</script>

</html>