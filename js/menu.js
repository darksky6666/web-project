function previewImg(e) {
    image.src=window.URL.createObjectURL(e.files[0]);
}

function checkData() {
    let foodPhoto = document.forms["addForm"]["foodPhoto"].value;
    
    if (foodPhoto == null | foodPhoto == "") {
        document.getElementById("picErr").innerHTML = "* Please select a photo.";
        return false;
    }
    return true;
}