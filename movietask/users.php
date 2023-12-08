<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
       body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        <a class="nav-link mx-3" href="users.php">Users</a>
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


<div class="container mt-4">
    <h2 class="text-center text-white bg-primary pb-1"> NUMBER OF USERS </h2>
    <table id="usersTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            // Replace with your PostgreSQL connection code
            $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");

            // Fetch booking history data from the database
            $query = "SELECT * FROM users";
            $result = pg_query($dbconn, $query);

            // Loop through the data and generate table rows
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['age']}</td>";
                echo "<td>{$row['gender']}</td>";
                echo "<td>{$row['mobile']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "</tr>";
            }

            // Close the PostgreSQL connection
            pg_close($dbconn);
            ?>
        </tbody>
    </table>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
});
</script>

</body>
</html>
