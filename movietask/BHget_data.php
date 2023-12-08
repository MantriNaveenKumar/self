<?php
$dbconn = pg_connect("host=localhost dbname=moviedatabase user=postgres password=root");

$query = "SELECT * FROM booking_history"; // Replace your_table_name with the actual table name
$result = pg_query($dbconn, $query);

$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

pg_close($dbconn);

// Return data as JSON
echo json_encode($data);
?>
