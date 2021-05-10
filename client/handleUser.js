const loadUser = (tagId, htmlNotLogin) => {
  const user_info = document.getElementById(`${tagId}`);
  $.ajax({
    url: "session.php",
    type: "POST",
    success: function (data) {
      if (data) {
        sessionStorage.setItem("username", data);
        user_info.innerHTML = `<strong>${data}</strong> <button class="btn-outline nav-btn-75 hvr-bounce-to-top" onclick="logout()">Logout</button>`;
      } else {
        user_info.innerHTML = htmlNotLogin;
      }
    },
  });
};
const logout = () => {
  const user_info = document.getElementById("user");
  $.ajax({
    url: "removeSession.php",
    type: "POST",
  });
  let html = `<button class="btn-outline nav-btn-75 hvr-bounce-to-top"><a href="./login.php" style="color: white">Sign In</a></button>  <button class="btn nav-btn-115 hvr-pulse-grow">Create account</button>`;
  sessionStorage.removeItem("username");
  user_info.innerHTML = html;
};
