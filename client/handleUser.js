const loadUser = async (tagId, allow) => {
  const user_info = document.getElementById(`${tagId}`);
  await $.ajax({
    url: "session.php",
    type: "POST",
    success: function (data) {
      if (data) {
        sessionStorage.setItem("username", data);
        user_info.innerHTML = `
          <select style="
                  color: white;
                  border: none;
                  background-color: transparent;
                  font-size: 16px;
                  ">
            <option selected disabled style="display: none;">Hi\,\ <strong>${data}</strong>\!\</option>
            <option onclick="window.location.href = './profile.php'">Your profile</option>
            <option onclick="logout(${allow})">Sign out</option>
          </select>
        `;
      } else {
        user_info.innerHTML = `
        <button class="btn-outline nav-btn-75 hvr-bounce-to-top">
          <a href="./login.php" style="color: white">Sign In</a>
        </button>  
        <button class="btn nav-btn-115 hvr-pulse-grow" style="width: 110px;">
          <a href="./signup.php" style="color: white">Create Account</a>
        </button>`;
      }
    },
  });
};
const logout = async (allow) => {
  const user_info = document.getElementById("user");
  await $.ajax({
    url: "removeSession.php",
    type: "POST",
  });
  let html = `
  <button class="btn-outline nav-btn-75 hvr-bounce-to-top">
    <a href="./login.php" style="color: white">Sign In</a>
  </button>  
  <button class="btn nav-btn-115 hvr-pulse-grow" style="width: 110px;">
    <a href="./signup.php" style="color: white">Create Account</a>
  </button>`;
  sessionStorage.removeItem("username");
  user_info.innerHTML = html;
  if (!allow) {
    window.location.replace("./index.php");
  }
};
