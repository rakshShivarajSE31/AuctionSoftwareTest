<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'chad'); // Update these values as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists and get their details
    $stmt = $conn->prepare("SELECT user_id, password, salt FROM ilance_users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $salt);
        $stmt->fetch();

        // Hash the input password with the user's salt
        $hashed_input_password = md5(md5($password) . $salt);

        // Check if hashed input password matches the stored password
        if ($hashed_input_password === $hashed_password) {
            // Create session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Redirect to the protected page or project list
            header("Location: index2.php"); // Redirect to the main page
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Username not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request method.";
}
