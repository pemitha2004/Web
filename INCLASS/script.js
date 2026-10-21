function showNotice(name) {
    alert(name + " is available in this portal. Open the Services page for more details.");
}

function checkApplication() {
    let fullName = document.getElementById("fullname").value.trim();
    let nicNo = document.getElementById("nic").value.trim();
    let emailAddress = document.getElementById("email").value.trim();
    let phoneNo = document.getElementById("phone").value.trim();

    if (fullName.length < 3) {
        alert("Please enter your full name.");
        return false;
    }

    if (nicNo.length < 9) {
        alert("Please enter a valid NIC number.");
        return false;
    }

    if (!emailAddress.includes("@") || !emailAddress.includes(".")) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (!/^[0-9]{10}$/.test(phoneNo)) {
        alert("Phone number should have 10 digits.");
        return false;
    }

    return confirm("Do you want to submit this application now?");
}

function askReset() {
    return confirm("Do you want to clear all entered details?");
}

function openHelpBox() {
    document.getElementById("helpBox").style.display = "flex";
}

function closeHelpBox() {
    document.getElementById("helpBox").style.display = "none";
}

window.onclick = function(e) {
    let box = document.getElementById("helpBox");
    if (e.target === box) {
        closeHelpBox();
    }
};
