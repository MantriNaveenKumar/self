<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");


    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $mobile = $_POST['edit_mobile'];
    $movie_title = $_POST['edit_movie_title'];
    $booking_date = $_POST['edit_booking_date'];
    $seats_count = $_POST['edit_seats_count'];
    $total_price = $_POST['edit_total_price'];

    $query = "UPDATE booking_history SET 
                username = '$username',
                email = '$email',
                mobile = '$mobile',
                movie_title = '$movie_title',
                booking_date = '$booking_date',
                seats_count = '$seats_count',
                total_price = '$total_price'
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

