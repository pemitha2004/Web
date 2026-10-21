function check() {

    var name = document.getElementById("name").value;
    var password = document.getElementById("password").value;
    var age = document.getElementById("age").value;

    if (name == "") {
        alert("Enter Name");
    } else if (password.length < 6) {
        alert("Password must be at least 6 characters");
    } else if (age < 15) {
        alert("Age must be 15 or above");
    } else {
        alert("Registration Successful");
    }
}
