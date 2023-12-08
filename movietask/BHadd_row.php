<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");



    $id = $_POST['id'];
        $username = $_POST['username']; 
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $movie_title = $_POST['movie_title'];
        $booking_date = $_POST['booking_date'];
        $seats_count = $_POST['seats_count'];
        $total_price = $_POST['total_price'];

        $query = "INSERT INTO show_timings (id,username,email,mobile,movie_title,booking_date,seats_count,total_price) VALUES ('$id',' $username,'$email','$mobile','$movie_title','$booking_date','$seats_count','$total_price')";
        
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
