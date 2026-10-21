<?php
function safeText($text) {
    return htmlspecialchars(trim($text));
}

function makeRef() {
    return "CHP-" . date("ymd") . "-" . rand(100, 999);
}

$sent = false;
$problems = [];
$chosenService = isset($_GET["service"]) ? safeText($_GET["service"]) : "";
$formData = [];

if (($_SERVER["REQUEST_METHOD"] ?? "GET") == "POST") {
    $inputs = ["fullname", "nic", "dob", "gender", "email", "phone", "address", "service", "district", "comments"];

    foreach ($inputs as $input) {
        $formData[$input] = isset($_POST[$input]) ? safeText($_POST[$input]) : "";
    }

    if ($formData["fullname"] == "") $problems[] = "Please enter your name.";
    if ($formData["nic"] == "") $problems[] = "Please enter your NIC number.";
    if ($formData["dob"] == "") $problems[] = "Please select your date of birth.";
    if ($formData["gender"] == "") $problems[] = "Please select gender.";
    if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) $problems[] = "Please enter a correct email address.";
    if ($formData["phone"] == "") $problems[] = "Please enter your phone number.";
    if ($formData["address"] == "") $problems[] = "Please enter your address.";
    if ($formData["service"] == "") $problems[] = "Please choose a service.";
    if ($formData["district"] == "") $problems[] = "Please choose a district.";

    if (count($problems) == 0) {
        $sent = true;
        $referenceNo = makeRef();
        $fileName = isset($_FILES["proof"]["name"]) && $_FILES["proof"]["name"] != "" ? safeText($_FILES["proof"]["name"]) : "No file selected";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="page-head">
        <div class="head-wrap">
            <h1>Citizen Help Portal</h1>
            <p>Online Service Application</p>
        </div>
        <nav class="menu">
            <a href="index.html">Home</a>
            <a href="services.html">Services</a>
            <a href="apply.php">Application</a>
        </nav>
    </header>

    <main class="page-content application-area">
        <h2 class="main-heading">Government Service Application</h2>

        <?php if ($sent): ?>
            <div class="ok-note">Your application was submitted successfully.</div>
            <section class="application-result">
                <h2>Application Details</h2>
                <p><b>Reference Number:</b> <?php echo $referenceNo; ?></p>
                <p><b>Name:</b> <?php echo $formData["fullname"]; ?></p>
                <p><b>NIC:</b> <?php echo $formData["nic"]; ?></p>
                <p><b>Date of Birth:</b> <?php echo $formData["dob"]; ?></p>
                <p><b>Gender:</b> <?php echo $formData["gender"]; ?></p>
                <p><b>Email:</b> <?php echo $formData["email"]; ?></p>
                <p><b>Phone:</b> <?php echo $formData["phone"]; ?></p>
                <p><b>Address:</b> <?php echo $formData["address"]; ?></p>
                <p><b>Service:</b> <?php echo $formData["service"]; ?></p>
                <p><b>District:</b> <?php echo $formData["district"]; ?></p>
                <p><b>Document:</b> <?php echo $fileName; ?></p>
                <p><b>Comments:</b> <?php echo $formData["comments"] == "" ? "No comments" : $formData["comments"]; ?></p>
                <div class="result-actions">
                    <button onclick="window.print()">Print</button>
                    <a href="index.html" class="apply-link">Home</a>
                </div>
            </section>
        <?php else: ?>
            <?php if (count($problems) > 0): ?>
                <div class="problem-box">
                    <?php foreach ($problems as $problem): ?>
                        <p><?php echo $problem; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="application-form" method="post" enctype="multipart/form-data" onsubmit="return checkApplication()">
                <label for="fullname">Full Name *</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

                <label for="nic">NIC / ID Number *</label>
                <input type="text" id="nic" name="nic" placeholder="Enter NIC number" required>

                <label for="dob">Date of Birth *</label>
                <input type="date" id="dob" name="dob" required>

                <label for="gender">Gender *</label>
                <select id="gender" name="gender" required>
                    <option value="">Choose Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" placeholder="name@email.com" required>

                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" placeholder="10 digit phone number" required>

                <label for="address">Home Address *</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter your address" required></textarea>

                <label for="service">Government Service *</label>
                <select id="service" name="service" required>
                    <option value="">Choose Service</option>
                    <option value="Birth Certificate" <?php echo $chosenService == "Birth Certificate" ? "selected" : ""; ?>>Birth Certificate</option>
                    <option value="National Identity Card" <?php echo $chosenService == "National Identity Card" ? "selected" : ""; ?>>National Identity Card</option>
                    <option value="Driving Licence" <?php echo $chosenService == "Driving Licence" ? "selected" : ""; ?>>Driving Licence</option>
                    <option value="Passport" <?php echo $chosenService == "Passport" ? "selected" : ""; ?>>Passport</option>
                    <option value="Business Registration" <?php echo $chosenService == "Business Registration" ? "selected" : ""; ?>>Business Registration</option>
                    <option value="Land Registration" <?php echo $chosenService == "Land Registration" ? "selected" : ""; ?>>Land Registration</option>
                </select>

                <label for="district">District *</label>
                <select id="district" name="district" required>
                    <option value="">Choose District</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Galle">Galle</option>
                    <option value="Matara">Matara</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                </select>

                <label for="proof">Supporting Document</label>
                <input type="file" id="proof" name="proof" accept=".pdf,.jpg,.jpeg,.png">

                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" rows="4" placeholder="Type extra details if needed"></textarea>

                <div class="form-actions">
                    <button type="submit">Send Application</button>
                    <button type="reset" class="reset-button" onclick="return askReset()">Clear</button>
                    <button type="button" class="help-button" onclick="openHelpBox()">Help</button>
                </div>
            </form>
        <?php endif; ?>
    </main>

    <div id="helpBox" class="help-screen">
        <div class="help-card">
            <h3>Need Help?</h3>
            <p>Complete all fields marked with *. Choose the service and district carefully. A PDF or image can be selected as a supporting document.</p>
            <button onclick="closeHelpBox()">Close</button>
        </div>
    </div>

    <footer class="page-footer">
        <p>2026 Citizen Help Portal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
