function addMenu() {
    window.location.href = "../ro_addMenuList.php";
    return false;
}

function previewImg(e) {
    image.src=window.URL.createObjectURL(e.files[0]);
}