function validate() {
    let password = document.getElementById("password").value;
    let passwordLength = password.length;
    let passwordBox = document.getElementById("password");

    if (passwordLength < 10) {
        alert('Password needs to be at least 10 characters');
        passwordBox.style.border = "red solid 3px";
        return false;
    }
}
