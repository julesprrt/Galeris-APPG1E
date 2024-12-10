function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();
  
    var imgtag = document.querySelectorAll(".myimage");
    var stop = false;
    imgtag.forEach(item => {
        console.log(item.title)
        if(item.title === "" && stop === false){
            item.title = selectedFile.name;
            reader.onload = function(event) {
                item.src = event.target.result;
            };
            reader.readAsDataURL(selectedFile);
            stop = true;
        }
    })
  }

  