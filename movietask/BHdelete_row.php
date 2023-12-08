<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");

    $id = $_POST['id'];

    $query = "DELETE FROM booking_history WHERE id = $id"; // Replace your_table_name with the actual table name
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
