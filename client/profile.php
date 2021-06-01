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
        <?php
            session_start();
            require './connection.php';
            $conn = openCon();
            mysqli_set_charset($conn, 'utf8');
            $sql = 'SELECT tacgia_ten, img, bio FROM tacgia WHERE tacgia_id = '.$_SESSION["userId"].'';
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
                echo '<img class="avatar" src="'.$row['img'].'"></img>';
                echo '<div class="name">';
                echo "<h1>".$row['tacgia_ten']."</h1>";
                echo "<p>".$row['bio']."</p>";
                echo "</div>";
            }
            echo $_SESSION["userId"];
        ?>
            <button class="edit" onclick="openModal()">Edit profile</button>
        </div>

        <div class="title-track"><h1>Your tracks</h1></div>

        <div class="owner-tracks">
            <?php
                mysqli_set_charset($conn, 'utf8');
                $sql = 'SELECT baihat_ten, baihat_image FROM baihat WHERE tacgia_id = '.$_SESSION["userId"].'';
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_assoc()) {
                echo '<div class="track">
                    <div class="image" style="background-image: url('.$row['baihat_image'].')"></div>
                    <div class="info">
                    <h3>'. $row['baihat_ten'] .'</h3>
                    <div class="control">
                    <button class="btn edit-track" onclick="openModalEdit(event)">Edit</button>
                    <button class="btn delete-track" onclick="handleDelete(event)">Delete</button>
                    </div>
                    </div>
                    </div>';
                }
            ?>
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

    <div class="modal-edit-profile" id="modal-track">
        <div action="" class="modal-content">
            <div class="modal-header">
                <h3>Edit track</h3>
            </div>
            <div class="modal-body">
                <label for="">Name's Track: </label>
                <input type="text" id="new_baihat_ten">
            </div>
            <div class="modal-footer">
                <div class="modal-control">
                    <button type="submit" onclick="handleEdit()">Save</button> 
                    <p type="cancel" onclick="closeModalEdit()">Cancel</p>
                </div>
            </div>
        </div>
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

    // >>> modal edit track >>>
    const openModalEdit = (e) => {
        const trackName = e.target.parentElement.parentElement.children[0].textContent;
        sessionStorage.setItem('track-to-edit', trackName);
        const modal = document.getElementById("modal-track");
        modal.style.visibility = "visible";     
        modal.style.opacity = 1;
    }
    const closeModalEdit = () => {
        sessionStorage.setItem('track-to-edit', '');
        const modal = document.getElementById("modal-track");
        modal.style.visibility = "hidden";     
        modal.style.opacity = 0;
    }
    // <<<

    // >>> handle edit >>>
        const handleEdit = async () => {
            const baihat_ten = sessionStorage.getItem('track-to-edit');
            const username = sessionStorage.getItem('username');
            await $.post(
                'edit-track.php',
                {
                    "baihat_ten": baihat_ten,
                    "new_baihat_ten": $('#new_baihat_ten').val(),
                    "username": username
                },
                (res) => {
                    // >>> check success edit user >>>
                    if(res) {
                        setTimeout(async () => {
                            await setValidate('edit-track', true);
                            window.location.reload();
                        },500);
                    } 
                    
                    if (res === false) {
                        setTimeout(async () => {
                            await setValidate('edit-track', false);
                            window.location.reload();
                        },500);
                    }
                    // <<<
                },
                'json'
            );
            closeModalEdit();
        }
    // <<<

    // >>> handle delete >>>
        const handleDelete = async (e) => {
            console.log("run");
            let confirmDelete = confirm('Are you sure to delete this track?');
            if(confirmDelete){
                const trackName = e.target.parentElement.parentElement.children[0].textContent;
                await $.post(
                    'delete-track.php',
                    {baihat_ten: trackName},
                    (res) => {
                        if(res) {
                            setTimeout(async () => {
                                await setValidate('delete-track', true);
                                window.location.reload();
                            },500);
                        } 
                            
                        if (res === false) {
                            setTimeout(async () => {
                                await setValidate('delete-track', false);
                                window.location.reload();
                            },500);
                        }
                    },
                    'json'
                );
            }
        }
    // <<<

    // >>> check validate >>>
        // >>> update profile
            if(getValidate('edit-user')) {
                notification('success', "Update your profile successfully!");
            } else if (getValidate('edit-user') === false) {
                notification('error', "Fail to update your profile!");
            }
        // <<<
        // >>> update track
            if(getValidate('edit-track')) {
                    notification('success', "Update your track successfully!");
            } else if (getValidate('edit-track') === false) {
                notification('error', "Fail to update your track!");
            }
        // <<<
        // >>> delete-track
            if(getValidate('delete-track')) {
                    notification('success', "Detele your track successfully!");
            } else if (getValidate('delete-track') === false) {
                notification('error', "Fail to Delete your track!");
            }
        // <<<
    //
</script>
</html>