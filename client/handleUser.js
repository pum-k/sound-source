const loadUser = (tagId,htmlNotLogin) => {
    const user_info = document.getElementById(`${tagId}`);
    console.log(user_info);
    $.ajax({
      url: "session.php",
      type: "POST",
      success: function(data) {
        if(data){ 
        sessionStorage.setItem("id_user", data);
        user_info.innerHTML = `Hi! ${data} <button class="btn-outline nav-btn-75 hvr-bounce-to-top" onclick="logout(${tagId})">Logout</button>`
      } else {
        user_info.innerHTML = htmlNotLogin;
      }
      }
    })
  }
  const logout = (tagId) => {
    const user_info = document.getElementById("user");
    $.ajax({
      url: "removeSession.php",
      type: "POST",
    })
    let html = `<button class="btn nav-btn-115 hvr-pulse-grow" onclick="window.location='http://localhost/sound-source/client/login.html'" >Sign in</button>`;
    sessionStorage.setItem("id_user","");
    user_info.innerHTML =  html;
  }