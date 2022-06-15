function deleteConfirmBox() {
    let deleteConfirm = confirm('Are you sure you want to remove this entry?\nThis process is not reversible.');
    if (deleteConfirm != true) {
        window.location.href = history.back();
    }
}