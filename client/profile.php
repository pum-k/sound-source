<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./navbar.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundSource</title>
    <link rel="stylesheet" href="./profile.css" />
</head>
<body>
    <div class="navbar">
        <div class="nav-content">
            <div class="direct">
                <div class="title">
                    <a href="./index.php">SoundSource</a>
                </div>
                <div class="item">
                    <a href="./index.php">Home</a>
                </div>
                <div class="item">
                    <a href="upload.php">Upload</a>
                </div>
            </div>
            <div class="item item-search">
                <input type="search" class="search_Song" />
                <i class="fas fa-search"></i>
            </div>
            <div class="item-user" id="user">
            </div>
        </div>
    </div>

    <div class="ctn-main">
        <div class="profile-header">
         <img class="avatar" src=""></img>
            <div class="name">
                <h1>Duong Dang Khoa</h1>
                <p>your fucking bio</p>
            </div>
            <button class="edit" onclick="openModal()">Edit profile</button>
        </div>

        <div class="title-track"><h1>Your tracks</h1></div>

        <div class="owner-tracks">
        <div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div>
        <div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div><div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div><div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div><div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div><div class='track'>
            <div class='image' style="background-image: url('')"></div>
            <div class="info">
                <h3>Track-name</h3>
                <div class="control">
                    <button class="btn edit-track">Edit</button>
                    <button class="btn delete-track">Delete</button>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal-edit-profile" id="modal">
        <form class="modal-content" action="./handle-edit-user.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h3>Edit your Profile</h3>
            </div>
            <div class="modal-body">
                <table style="width: 100%;">
                    <tr>
                        <th class="left">
                            <img src="" class='avatar' id="avatar">
                            <input id="uploadNewAvatar" type="file" name="image" accept="image/*">
                        </th>
                        <th class="right">
                            <label>Display name<font color="red">*</font>:</label>
                            <input type="text" name="displayName" id="displayName" value="" required minLength="5">
                            <label>Bio:</label>
                            <textarea name="bio" id="bio" maxlength = "150" placeholder="Your bio here... (less than 150 characters)"></textarea>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div class="modal-control">
                    <button type="submit">Save</button> 
                    <p type="cancel" onclick="closeModal()">Cancel</p>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://kit.fontawesome.com/3e954ec838.js" crossorigin="anonymous"></script>
<script src="./handleUser.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="handle-session-validate.js"></script>
<script src="Notification.js"></script>
<script>
    // check is logged >>>
    if(!sessionStorage.getItem('username')){
      window.location.replace('http://localhost/sound-source/client/index.php');
    }
    const notLoggedIn =  "window.location = 'http://localhost/sound-source/client/login.php'";
    loadUser("user", false);
    // <<<

    // >>> search for >>>
    // <<<

    // >>> modal >>>
    const openModal = () => {
        const modal = document.getElementById("modal");
       modal.style.visibility = "visible";
        modal.style.opacity = 1;
    }
    const closeModal = () => {
        const modal = document.getElementById("modal");
        modal.style.visibility = "hidden";     
        modal.style.opacity = 0;
    }
    // <<<
    
    // >>> upload new uploadNewAvatar >>>
    const input = document.getElementById("uploadNewAvatar");
    input.onchange = (e) => {
        const [file] = input['files'];
        if(file) document.getElementById("avatar").src = URL.createObjectURL(file);
    }
    // <<<

    // >>> check success >>>
    let validate = getValidate('edit-user');
    if(validate) {
        notification('success', 'Update your profile successfully');
        deleteValidate('edit-user');
    } 
    
    if (validate === false) {
        notification('error', 'Fail to update your profile, please try again!');
        deleteValidate('edit-user');
    }
    // <<<


</script>
</html>