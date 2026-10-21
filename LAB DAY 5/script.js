function validateForm() {
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("ageError").innerHTML = "";
    document.getElementById("phoneError").innerHTML = "";
    document.getElementById("genderError").innerHTML = "";
    document.getElementById("jobError").innerHTML = "";
    document.getElementById("experienceError").innerHTML = "";
    document.getElementById("resumeError").innerHTML = "";
    document.getElementById("skillError").innerHTML = "";
    document.getElementById("success").innerHTML = "";

    let valid = true;

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let age = document.getElementById("age").value;
    let phone = document.getElementById("phone").value;
    let job = document.getElementById("job").value;
    let experience = document.getElementById("experience").value;
    let resume = document.getElementById("resume").value;

    if (name == "" || !/^[A-Za-z ]+$/.test(name)) {
        document.getElementById("nameError").innerHTML = "Enter a valid name.";
        valid = false;
    }

    if (email == "" || !email.includes("@") || !email.includes(".")) {
        document.getElementById("emailError").innerHTML = "Enter a valid email.";
        valid = false;
    }

    if (age < 18 || age > 60) {
        document.getElementById("ageError").innerHTML = "Age must be between 18 and 60.";
        valid = false;
    }

    if (!/^[0-9]{10}$/.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Phone must contain exactly 10 digits.";
        valid = false;
    }

    let gender = document.getElementsByName("gender");
    let selected = false;

    for (let i = 0; i < gender.length; i++) {
        if (gender[i].checked) {
            selected = true;
        }
    }

    if (!selected) {
        document.getElementById("genderError").innerHTML = "Select a gender.";
        valid = false;
    }

    if (job == "") {
        document.getElementById("jobError").innerHTML = "Select a job position.";
        valid = false;
    }

    if (experience == "" || experience < 0) {
        document.getElementById("experienceError").innerHTML = "Enter valid experience.";
        valid = false;
    }

    if (resume == "" || !resume.endsWith(".pdf")) {
        document.getElementById("resumeError").innerHTML = "Upload a PDF file.";
        valid = false;
    }


    let skills = document.getElementsByName("skill");
    let skillSelected = false;

    for (let i = 0; i < skills.length; i++) {
        if (skills[i].checked) {
            skillSelected = true;
        }
    }

    if (!skillSelected) {
        document.getElementById("skillError").innerHTML = "Select at least one skill.";
        valid = false;
    }

    if (valid) {
        document.getElementById("success").innerHTML =
        "Application Submitted Successfully!";
    }

    return false;
}