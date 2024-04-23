<?php
session_start();
include("db_connection.php");

if(isset($_GET['id']) && isset($_GET['username'])) {
    $id = $_GET['id'];
    $username = $_GET['username'];

    $deleteSql = "DELETE FROM employer WHERE id = '$id'";
    if ($conn->query($deleteSql) === TRUE) {
        $_SESSION['success'] = "Employer deleted successfully.";

        $deleteSql2 = "DELETE FROM availability WHERE username = '$username'";
        if ($conn->query($deleteSql2) === TRUE) {
            header("Location: empmanage.php");
            exit();
        } else {
            $_SESSION['error'] = "Error deleting employer availability: " . $conn->error;
            header("Location: empmanage.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Error deleting employer: " . $conn->error;
        header("Location: empmanage.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: empmanage.php");
    exit();
}

$conn->close();
?>
