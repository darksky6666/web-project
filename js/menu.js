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

function filterCat(catName) {
    const fCat = document.getElementsByClassName("fCat");

    // If all categories are selected, show all foods
    if (catName === "All") {
        for (let i = 0; i < fCat.length; i++) {
            fCat[i].parentElement.style.display = "block";
        }
    // If a category is selected, show only the foods in that category
    } else {
        for (let i = 0; i < fCat.length; i++) {
            // If food category is not the selected category, hide it
            if (fCat[i].innerHTML !== catName) {
                fCat[i].parentElement.style.display = "none";
            } else {
            // If food category is the selected category, show it
                fCat[i].parentElement.style.display = "block";
            }
        }
    }
}

function deleteConfirmBox() {
    let deleteConfirm = confirm('Are you sure you want to remove this entry?\nThis process is not reversible.');
    if (deleteConfirm != true) {
        window.location.href = history.back();
    }
}

function totalOrderPrice(price) {
    let total = document.getElementById("total");
    let totalPrice = parseFloat(total.innerHTML);
    totalPrice += parseFloat(price);
    total.innerHTML = totalPrice.toFixed(2);
}