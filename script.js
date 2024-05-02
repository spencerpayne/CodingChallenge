function validate() {
    let password = document.getElementById("password").value;
    let passwordLength = password.length;
    let passwordBox = document.getElementById("password");

    if (passwordLength < 10) {
        alert('Password needs to be at least 10 characters');
        passwordBox.style.border = "red solid 3px";
        return false;
    }

    let email = document.getElementById("email").value;
    let emailInput = document.getElementById("email");

    let emailRegex =
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    // if statement that tests the student email value with the regex
    if (emailRegex.test(email) === false) {
        emailInput.style.border = "red solid 3px";
        alert('Email not valid');
        return false;
    }
}
