<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "team_reg_detials";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("SELECT contactno FROM details WHERE contactno = ?");
$stmt->bind_param("s", $contactno);

// Set parameters and execute
$contactno = $conn->real_escape_string($_POST['contactno']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "This contact number is already registered.";
} else {
    $stmt = $conn->prepare("INSERT INTO details (teamname, captainname, contactno, place, advancepaid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $teamname, $captainname, $contactno, $place, $advancepaid);

    $teamname = $conn->real_escape_string($_POST['teamname']);
    $captainname = $conn->real_escape_string($_POST['captainname']);
    $place = $conn->real_escape_string($_POST['place']);
    $advancepaid = $conn->real_escape_string($_POST['advancepaid']);
    $stmt->execute();

    echo "New records created successfully";
}
$stmt->close();
$conn->close();
?>
