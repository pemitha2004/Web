<?php
$conn = new mysqli("localhost", "root", "");

$conn->query("CREATE DATABASE IF NOT EXISTS attendance_system");
$conn->select_db("attendance_system");

$conn->query("CREATE TABLE IF NOT EXISTS attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) NOT NULL,
    module_code VARCHAR(20),
    attendance_status VARCHAR(20),
    attendance_date DATE
)");

$conn->query("INSERT INTO attendance
(student_name, student_id, module_code, attendance_status, attendance_date)
VALUES
('Kamal Perera','ST001','IT101','Present','2026-08-25'),
('Nimal Silva','ST002','IT101','Absent','2026-08-25'),
('Amal Fernando','ST003','IT102','Present','2026-08-25')");

$result = $conn->query(
    "SELECT * FROM attendance WHERE attendance_status='Present'"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>

    <style>
        body {
            font-family: Arial;
            background: #eef2ff;
            text-align: center;
            padding: 40px;
        }

        h2 {
            color: #4f46e5;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 15px #bbb;
        }

        th {
            background: #4f46e5;
            color: white;
            padding: 15px;
        }

        td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #eef2ff;
        }

        tr:hover {
            background: #c7d2fe;
        }

        .present {
            color: green;
            font-weight: bold;
        }

        .total {
            color: #4f46e5;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>🎓 Present Students</h2>

<?php
if ($result->num_rows > 0) {

    echo "<table>
    <tr>
        <th>Attendance ID</th>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Module</th>
        <th>Status</th>
        <th>Date</th>
    </tr>";

    $count = 0;

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['attendance_id']}</td>
        <td>{$row['student_name']}</td>
        <td>{$row['student_id']}</td>
        <td>{$row['module_code']}</td>
        <td class='present'>{$row['attendance_status']}</td>
        <td>{$row['attendance_date']}</td>
        </tr>";

        $count++;
    }

    echo "</table>";
    echo "<p class='total'>Total Present Students: $count</p>";

} else {
    echo "<p>No students are Present.</p>";
}

$conn->close();
?>

</body>
</html>