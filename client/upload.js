const uploadPhoto = (e) => {
  document.getElementById("fileUpload").click();
  //   console.log(e);
};

const inputUploadPhoto = (input) => {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = (e) => {
      // document.getElementById("photo").style.backgroundImage =
      //   "url(" + e.target.result + ")";
      console.log(e.target.result);
    };
  }
};
