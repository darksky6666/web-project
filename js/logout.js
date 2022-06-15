function logout() {
    let confirmBox = confirm("Are you sure you want to logout?");
    if (confirmBox == true) {
        location.replace("../manage_user/logout.php");
        return true;
    }
    return false;
}