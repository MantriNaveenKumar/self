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
        <a class="nav-link mx-3" href="showtimings.php" >Show Timings</a>
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

    <div class="container mt-3">
    <div class="mb-3">
        <label for="searchInput" class="form-label text-white">Search by Title:</label>
        <input type="text" class="form-control" id="searchInput" placeholder="Enter movie title">
    </div>
</div>


<?php
$searchData = [
    ['term' => 'conjuring', 'title' => 'The Conjuring'],
    ['term' => 'avengers', 'title' => 'avengers'],
    ['term' => 'adventure', 'title' => 'Adventure'],
    ['term' => 'guardians+of+the+galaxy', 'title' => 'Guardians of the Galaxy'],
    ['term' => 'alien', 'title' => 'alien']
];

$apiKey = "fc1fef96";

?>

<div class="container mt-5 bg-dark">
    <?php foreach ($searchData as $data) { ?>
        <?php
        $apiUrl = "https://www.omdbapi.com/?s=${data['term']}&page=1&apikey=${apiKey}";
        $response = file_get_contents($apiUrl);
        $responseData = json_decode($response, true);

        $movies = [];

        if (isset($responseData['Search'])) {
            $movies = $responseData['Search'];
        }
        ?>

        <h3><?php echo $data['title']; ?></h3>
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php foreach ($movies as $movie) { ?>
                <div class="col">
                    <div class="card ">
                        <img src="<?php echo $movie['Poster']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $movie['Title']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
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

<!--search functionality -->
<script>
    $(document).ready(function() {
        $("#searchInput").on("input", function() {
            var searchTerm = $(this).val();
            var apiKey = "fc1fef96";
            var apiUrl = `https://www.omdbapi.com/?s=${searchTerm}&page=1&apikey=${apiKey}`;

            $.get(apiUrl, function(data) {
                var movies = data.Search;
                var movieContainer = $(".row-cols-1");
                movieContainer.empty();

                if (movies) {
                    $.each(movies, function(index, movie) {
                        var movieCard = `
                            <div class="col">
                                <div class="card">
                                    <img src="${movie.Poster}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">${movie.Title}</h5>
                                    </div>
                                </div>
                            </div>
                        `;
                        movieContainer.append(movieCard);
                    });
                } else {
                    movieContainer.html("<p>No movies found.</p>");
                }
            });
        });
    });
</script>


  <!---- Include Bootstrap JS and other scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>
