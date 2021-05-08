const loadUser = (tagId,htmlNotLogin) => {
    const user_info = document.getElementById(`${tagId}`);
    console.log(`tag: ${tagId}`);
    $.ajax({
      url: "session.php",
      type: "POST",
      success: function(data) {
        if(data){ 
        sessionStorage.setItem("id_user", data);
        user_info.innerHTML = `Hi! ${data} <button class="btn" onclick="logout()">Logout</button>`
      } else {
        user_info.innerHTML = htmlNotLogin;
      }
      }
    })
  }
  const logout = (tagId,htmlNotLogin) => {
    const user_info = document.getElementById("user");
    $.ajax({
      url: "removeSession.php",
      type: "POST",
    })
    sessionStorage.setItem("id_user","");
    user_info.innerHTML = htmlNotLogin;
  }