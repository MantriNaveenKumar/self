<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");

    $id = $_POST['edit_id'];
    $movie_title = $_POST['edit_movie_title'];
    $show_date = $_POST['edit_show_date'];
    $show_time = $_POST['edit_show_time'];
    $cinema_hall = $_POST['edit_cinema_hall'];
    $available_seats = $_POST['edit_available_seats'];

    $query = "UPDATE show_timings SET 
                movie_title = '$movie_title',
                show_date = '$show_date',
                show_time = '$show_time',
                cinema_hall = '$cinema_hall',
                available_seats = '$available_seats'
                WHERE id = $id";
    
    $result = pg_query($dbconn, $query);
    if ($result) {
        $response['success'] = true;
        $response['message'] = "Row updated successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating row.";
    }
    pg_close($dbconn);

    // Return the response as JSON
    echo json_encode($response);
}
?>
