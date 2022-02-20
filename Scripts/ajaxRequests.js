function UserAccountRequest(currentContent) {
    var XmlHttp = new XMLHttpRequest();
    XmlHttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "LoginRedirect") {
                window.location.href = "../Pages/login.php";
            } else {
                document.getElementById("clearButton").innerHTML = this.responseText;
            }
        }
    }
    XmlHttp.open("POST", "../Scripts/UserAccountRequest.php", true)
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Allow to send post request such as in a form
    XmlHttp.send("currentState=" + currentContent.replaceAll(" ", "+") );
}