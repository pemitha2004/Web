function validateForm() {

    let id = document.getElementById("id").value;
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let mobile = document.getElementById("mobile").value;
    let picture = document.getElementById("picture").value;
    let documentFile = document.getElementById("document").value;

    if (id == "" || name == "" || email == "" || mobile == "" || picture == "" || documentFile == "") {
        alert("Please fill all fields.");
        return false;
    }

    alert("Registration Successful!");
    return true;
} 