function generateQR(id, status) {
    const qrcode = document.getElementById("qrcode");
    const statusText = document.getElementById("statusText");

    if (qrcode.innerHTML != null) {
        qrcode.innerHTML = "";
    }

    statusText.innerHTML = "Please Scan QR to change order status to " + '<span style="font-weight: bold;">' + status + ".</span>";
    const qr = new QRCode(qrcode);

    // Temp link
    qr.makeCode(`http://127.0.0.1/project/db/updateOrderStatus.php?id=${id}&status=${status}`);
}
