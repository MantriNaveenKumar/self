<?php
// Include your database connection configuration here
 $dbConnection = new PDO("pgsql:host=localhost;dbname=moviedatabase", "postgres", "root");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email or mobile already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = :email OR mobile = :mobile";
    $checkStmt = $dbConnection->prepare($checkQuery);
    $checkStmt->bindParam(":email", $email);
    $checkStmt->bindParam(":mobile", $mobile);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
      
      $message = "User with this email or mobile already exists.";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users (name, age, gender, mobile, email, password) VALUES (:name, :age, :gender, :mobile, :email, :password)";
        $insertStmt = $dbConnection->prepare($insertQuery);
        $insertStmt->bindParam(":name", $name);
        $insertStmt->bindParam(":age", $age);
        $insertStmt->bindParam(":gender", $gender);
        $insertStmt->bindParam(":mobile", $mobile);
        $insertStmt->bindParam(":email", $email);
        $insertStmt->bindParam(":password", $hashedPassword);
        
        $insertStmt->execute();

       
          // Set a success message
    $message = "Registration successful!";
    }
    // Redirect back to index.php with the message as a URL parameter
header('Location: index.php?message=' . urlencode($message));
exit();
}
?>

