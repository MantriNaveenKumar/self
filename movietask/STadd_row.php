<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");

    $id = $_POST['id'];
        $movie_title = $_POST['movie_title']; 
        $show_date = $_POST['show_date'];
        $show_time = $_POST['show_time'];
        $cinema_hall = $_POST['cinema_hall'];
        $available_seats = $_POST['available_seats'];

        $query = "INSERT INTO show_timings (id,movie_title,show_date,show_time,cinema_hall,available_seats) VALUES ('$id','$movie_title','$show_date','$show_time','$cinema_hall','$available_seats')";
        
    $result = pg_query($dbconn, $query);
    if ($result) {
        $response['success'] = true;
        $response['message'] = "Row added successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error adding row.";
    }
    pg_close($dbconn);
}
?>
