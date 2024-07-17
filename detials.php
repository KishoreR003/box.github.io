<?php
$teamname = $_POST['teamname'];
$captainname = $_POST['captainname'];
$contactno = $_POST['contactno'];
$place = $_POST['place'];
$advancepaid = $_POST['advancepaid'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'team_reg_detials');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Insert new record
    $stmt = $conn->prepare("INSERT INTO details (teamname, captainname, contactno, place, advancepaid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $teamname, $captainname, $contactno, $place, $advancepaid);
    $execval = $stmt->execute();
    echo $execval;
    echo "registered successfully";
    $stmt->close();
    $conn->close();
}
?>
