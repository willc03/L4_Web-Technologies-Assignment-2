function UserAccountRequest(currentContent) {
    // AJAX request information was found at w3schools (n.d. a)
    var XmlHttp = new XMLHttpRequest();
    XmlHttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "LoginRedirect") {
                window.location.href = "../Pages/login.php";
            } else {
                document.getElementById("clearButton").innerHTML = this.responseText;
                window.location.reload();
            }
        }
    }
    XmlHttp.open("POST", "../Scripts/Server/UserAccountRequest.php", true)
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Allow to send post request such as in a form
    XmlHttp.send("currentState=" + currentContent.replaceAll(" ", "+") );
}