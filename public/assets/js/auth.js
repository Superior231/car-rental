// Show Pass
function showPass() {
    const passwordInput = document.getElementById("password");
    const passwordType = passwordInput.type;

    if (passwordType === "password") {
        passwordInput.type = "text";
        document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye"></i>';
    } else {
        passwordInput.type = "password";
        document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
    }
}

function showPass2() {
    const passwordInput = document.getElementById("password_confirmation");
    const passwordType = passwordInput.type;

    if (passwordType === "password") {
        passwordInput.type = "text";
        document.getElementById("showPass2").innerHTML = '<i class="fa-regular fa-eye"></i>';
    } else {
        passwordInput.type = "password";
        document.getElementById("showPass2").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
    }
}

function showPass3() {
    const passwordInput = document.getElementById("edit-password");
    const passwordType = passwordInput.type;

    if (passwordType === "password") {
        passwordInput.type = "text";
        document.getElementById("showPass3").innerHTML = '<i class="fa-regular fa-eye"></i>';
    } else {
        passwordInput.type = "password";
        document.getElementById("showPass3").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
    }
}
// Show Pass End
