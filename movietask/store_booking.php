<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["username"])) {
  //  $email = $_SESSION["username"];
    header("Location: login.html");
    exit();
}

// Include your database connection configuration here
$dbConnection = new PDO("pgsql:host=localhost;dbname=moviedatabase", "postgres", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user details from the session
    $email = $_SESSION["username"]; // Assuming the user's email is stored as username in session

    // ... (rest of your code)
      // Retrieve user details from the database
      $selectUserQuery = "SELECT name, email, mobile FROM users WHERE email = :email";
      $selectUserStmt = $dbConnection->prepare($selectUserQuery);
      $selectUserStmt->bindParam(":email", $email);
      $selectUserStmt->execute();
      $userDetails = $selectUserStmt->fetch(PDO::FETCH_ASSOC);
  
      if ($userDetails) {
          $username = $userDetails["name"];
          $email = $userDetails["email"];
          $mobile = $userDetails["mobile"];
          $movieTitle = $_POST["movieTitle"];
          $bookingDate = $_POST["bookingDate"];
          $seatsCount = $_POST["seatsCount"];
          $totalPrice = $_POST["totalPrice"];
  
          // Insert booking record into the database
          $insertQuery = "INSERT INTO booking_history (username, email, mobile, movie_title, booking_date, seats_count, total_price) 
                          VALUES (:username, :email, :mobile, :movie_title, :booking_date, :seats_count, :total_price)";
          $insertStmt = $dbConnection->prepare($insertQuery);
          $insertStmt->bindParam(":username", $username);
          $insertStmt->bindParam(":email", $email);
          $insertStmt->bindParam(":mobile", $mobile);
          $insertStmt->bindParam(":movie_title", $movieTitle);
          $insertStmt->bindParam(":booking_date", $bookingDate);
          $insertStmt->bindParam(":seats_count", $seatsCount);
          $insertStmt->bindParam(":total_price", $totalPrice);
  

    if ($insertStmt->execute()) {
       // echo "Booking successful!";
       echo '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Booking Confirmation</title>
            <!-- Include Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <h1 class="text-center">Booking Confirmation</h1>
                <div class="card mx-auto mt-2" style="max-width: 400px;">
                    <div class="card-body bg-danger">
                        <h2 class="card-title text-center pb-4 bg-warning">Ticket Details</h2>
                        <p class="card-text"><strong>Name:</strong> ' . $username . '</p>
                        <p class="card-text"><strong>Email:</strong> ' . $email . '</p>
                        <p class="card-text"><strong>Mobile:</strong> ' . $mobile . '</p>
                        <p class="card-text"><strong>Movie Title:</strong> ' . $movieTitle . '</p>
                        <p class="card-text"><strong>Booking Date:</strong> ' . $bookingDate . '</p>
                        <p class="card-text"><strong>Seats Count:</strong> ' . $seatsCount . '</p>
                        <p class="card-text"><strong>Total Price:</strong> $' . $totalPrice . '</p>
                        <hr/>
                    
                    <p>Thank you for booking! Please present this ticket at the cinema.</p>
                        </div>
                    
                     
                    
                </div>
            </div>
            <!-- Include Bootstrap JS (optional) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        </body>
        </html>';
    } else {
        echo "Booking failed. Please try again.";
        var_dump($insertStmt->errorInfo()); // Debugging
    }
}
}
?>
