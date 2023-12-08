

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #d1c7c7;
        }

        .container {
            flex: 1;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand order-lg-1 me-auto" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse order-lg-3" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
        <a class="nav-link mx-3 text-white" href="adminpanel.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="movies.php">Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="showtimings.php" id="" >Show Timings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="users.php" id="" >Users</a>
      </li>
      <li class="nav-item">
    <a class="nav-link mx-3" href="getbookings.php">Bookings</a>
</li>

      <li class="nav-item">
        <a class="nav-link mx-3" href="" id="logoutLink" >Logout</a>
      </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container d-flex justify-content-center mt-5">
    <div class="text-center">
    <h1>Admin Dashboard</h1>
    <h3>Welcome to the admin panel. Manage your movies and users here.</h3>
    </div>
   
</div>


<?php include 'footer.php'; ?>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $("#logoutLink").click(function(event) {
    event.preventDefault(); // Prevent default link behavior
    // Redirect to index.php
    window.location.href = "index.php";
  });
});
</script>


  <!---- Include Bootstrap JS and other scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
