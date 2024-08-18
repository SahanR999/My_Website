<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "student_managment_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert message into the database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "<h2>Thank you for your message, $name!</h2>";
    echo "<p>We will get back to you at $email.</p>";
    echo "<a href='index.html'>Go back to the homepage</a>";
} else {
    echo "<h2>Error: Please submit the form properly.</h2>";
}
?>
