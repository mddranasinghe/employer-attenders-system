<?php
include "db_connection.php";
// Check if date parameter is set
if (isset($_POST['date'])) {
    $date = $_POST['date'];


    // Check if the date already exists in the database
    $check_query = "SELECT * FROM availability WHERE date='$date'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Date exists, so delete it
        $delete_query = "DELETE FROM availability WHERE date='$date'";
        if ($conn->query($delete_query) === TRUE) {
            echo "Date deleted successfully";
        } else {
            echo "Error deleting date: " . $conn->error;
        }
    } else {
        // Date doesn't exist, so insert it
        $insert_query = "INSERT INTO availability (date) VALUES ('$date')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Date inserted successfully";
        } else {
            echo "Error inserting date: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
} else {
    echo "Date parameter not set";
}
?>
