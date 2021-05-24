const notification = (status, message) => {
  let container = document.createElement("div");
  if (status === "success") {
    container.style.cssText =
      "position: fixed; top: 0; height: 70px; width: 100%;font-size: 24px; display: flex; justify-content: center; align-items: center ;background: #42ba96; transition: 0.4s ease-in-out; opacity: 0";
    container.innerHTML = message;
  }
  if (status === "error") {
    container.style.cssText =
      "position: fixed; top: 0; height: 70px; width: 100%;font-size: 24px; display: flex; justify-content: center; align-items: center ;background: #E93E36; transition: 0.4s ease-in-out; opacity: 0";
    container.innerHTML = message;
  }
  document.body.appendChild(container);
  setTimeout(() => {
    container.style.opacity = 1;
    setTimeout(() => {
      container.style.opacity = 0;
      setTimeout(() => {
        container.remove();
      }, 1000);
    }, 3000);
  }, 100);
};
