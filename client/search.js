const btnTypes = document.getElementsByClassName("btn-type");
let triangle = document.getElementsByClassName("triangle-right");
triangle[0].style.display = "block";

for (let i = 0; i < btnTypes.length; i++) {
  btnTypes[i].addEventListener("click", function () {
    let triangle = document.getElementsByClassName("triangle-right");
    for (let j = 0; j < triangle.length; j++) {
      triangle[j].style.display = "none";
    }
    let current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    this.parentNode.lastElementChild.style.display = "block";
  });
}
