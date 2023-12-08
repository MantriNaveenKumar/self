<!DOCTYPE html>
<html>
<head>
    <title>Table with Add, Edit, Delete, and View More Functionalities</title>
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
        .addForm
        {
            height: 50px;
            width: 100%;
            background-color: #A52307;
            border-radius: 5%;
        }
     </style>
</head>


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

<body class="bg-success">
    <div class="container">
        <h2 class="bg-success text-center text-white">SHOW TIMINGS</h2>
        <table class="table table-dark table-bordered table-striped" id="displaytable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MOVIE TITLE</th>
                    <th>SHOW DATE</th>
                    <th>SHOW TIME</th>
                    <th>CINEMA HALL</th>
                    <th>AVAILABLE SEATS</th>
                    <th>Actions</th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="addForm">
        <form id="addForm" class="d-flex justify-content-around align-items-center border border-0 mt-4 bg-opacity-75">
            <input type="number" name="id" placeholder="id">
            <input type="text" name="movie_title" placeholder="movie_title">
            <input type="date" name="show_date" placeholder="show_date">
            <input type="time" name="show_time" placeholder="show_time">
            <input type="text" name="cinema_hall" placeholder="cinema_hall">
            <input type="number" name="available_seats" placeholder="available_seats">
            <button type="button" id="addButton" class="border border-rounded btn btn-primary mt-1">Add</button>
        </form>
        </div>
    </div>

    <!-- Edit Form -->
    <div id="editForm" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Row</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="edit_id">
                        <div class="mb-3">
                            <label for="edit_movie_title" class="form-label">Movie Title</label>
                            <input type="text" class="form-control" id="edit_movie_title" name="edit_movie_title">
                        </div>
                        <div class="mb-3">
                            <label for="edit_show_date" class="form-label">Show Date</label>
                            <input type="date" class="form-control" id="edit_show_date" name="edit_show_date">
                        </div>
                        <div class="mb-3">
                            <label for="edit_show_time" class="form-label">Show Time</label>
                            <input type="time" class="form-control" id="edit_show_time" name="edit_show_time">
                        </div>
                        <div class="mb-3">
                            <label for="edit_cinema_hall" class="form-label">Cinema Hall</label>
                            <input type="text" class="form-control" id="edit_cinema_hall" name="edit_cinema_hall">
                        </div>
                        <div class="mb-3">
                            <label for="edit_available_seats" class="form-label">Available Seats</label>
                            <input type="number" class="form-control" id="edit_available_seats" name="edit_available_seats">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveButton" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Card -->
    <div id="detailsCard" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Details</h5>
                    <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button> 
                   
                </div>
                <div class="modal-body" id="detailsCardBody">
                    <!-- Card content will be populated here -->
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
$(document).ready(function() {
  $("#logoutLink").click(function(event) {
    event.preventDefault(); // Prevent default link behavior
    // Redirect to index.php
    window.location.href = "index.php";
  });
});
</script>

   
   <script>
        $(document).ready(function() {
            var dataTable = $('#displaytable').DataTable();

            // Load data using AJAX on page load
            loadData();

            // Add Button Click Event
            $('#addButton').click(function() {
                var formData = $('#addForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'STadd_row.php', // Backend script for adding data
                    data: formData,
                    success: function(response) {
                        // Clear form fields 
                        $('#addForm')[0].reset();
                        // Reload data
                        loadData();
                    }
                });
            });

            // Edit Button Click Event
            $(document).on('click', '.editButton', function() {
                var id = $(this).data('id');
                var row = dataTable.row($(this).parents('tr')).data();

                // Fill the edit form fields with the row data
                $('#editForm [name="edit_id"]').val(id);
                $('#edit_movie_title').val(row[1]);
                $('#edit_show_date').val(row[2]);
                $('#edit_show_time').val(row[3]);
                $('#edit_cinema_hall').val(row[4]);
                $('#edit_available_seats').val(row[5]);

                // Show the edit form as a modal
                $('#editForm').modal('show');
            });

            // Save Button Click Event
            $('#saveButton').click(function() {
                var formData = $('#editForm form').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'STedit_row.php', // Backend script for editing data
                    data: formData,
                    success: function(response) {
                        // Clear edit form fields
                        $('#editForm form')[0].reset();
                        // Hide the edit form modal
                        $('#editForm').modal('hide');
                        // Reload data
                        loadData();
                    }
                });
            });
             
            // Delete Button Click Event
$(document).on('click', '.deleteButton', function() {
    var id = $(this).data('id');
    
    // Show a confirmation dialog before deleting
    if (confirm("Are you sure you want to delete this record?")) {
        // Send an AJAX request to delete the record
        $.ajax({
            type: 'POST',
            url: 'STdelete_row.php', // Backend script for deleting data
            data: { id: id }, // Send the ID of the record to delete
            success: function(response) {
                // Reload data
                loadData();
            }
        });
    }
});

            // View More Button Card Click Event
            $(document).on('click', '.viewMoreButton', function() {
                var row = dataTable.row($(this).parents('tr')).data();
                var columnNames = ["ID", "Movie Title", "Show Date", "Show Time", "Cinema Hall", "Available Seats"];
                var detailsContent = "";

                for (var i = 0; i < columnNames.length; i++) {
                    detailsContent += '<p><strong>' + columnNames[i] + ':</strong> ' + row[i] + '</p>';
                }

                $('#detailsCardBody').html(detailsContent);
                // Show the details card as a modal
                $('#detailsCard').modal('show');
            });

             
            
            function loadData() {
                $.ajax({
                    type: 'GET',
                    url: 'STget_data.php', // Backend script to fetch data
                    dataType: 'json',
                    success: function(data) {
                        dataTable.clear().draw();
                        data.forEach(function(row) {
                            var editButton = '<button class="editButton btn btn-success" data-id="' + row.id + '">Edit</button>';
                            var deleteButton = '<button class="deleteButton btn btn-danger mt-2" data-id="' + row.id + '">Delete</button>';
                            var viewMoreButton = '<button class="viewMoreButton btn btn-info" data-id="' + row.id + '">View More</button>';

                            dataTable.row.add([
                                row.id,
                                row.movie_title,
                                row.show_date,
                                row.show_time,
                                row.cinema_hall,
                                row.available_seats,
                                editButton + ' ' + deleteButton,
                                viewMoreButton
                            ]).draw();
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
