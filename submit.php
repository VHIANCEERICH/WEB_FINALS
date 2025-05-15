<?php
$host = "localhost";
$user = "root"; 
$password = "Leahjamo01"; 
$database = "glowup_Beauty";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}


$sql = "INSERT INTO signups (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);


if ($stmt->execute()) {
    echo "Thank you for signing up!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
