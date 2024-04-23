<?php
session_start();
include("db_connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM employer WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $sex = $row['sex'];
        $address = $row['address'];
        $tel = $row['tel'];
    } else {
        $_SESSION['error'] = "Employer not found.";
        header("Location: empmanage.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: empmanage.php");
    exit();
}

if(isset($_POST['submit'])) {
    $newUsername = $_POST['username'];
    $newSex = $_POST['sex'];
    $newAddress = $_POST['address'];
    $newTel = $_POST['tel'];

    $updateSql = "UPDATE employer SET username = '$newUsername', sex = '$newSex', address = '$newAddress', tel = '$newTel' WHERE id = '$id'";
    if ($conn->query($updateSql) === TRUE) {
        $_SESSION['success'] = "Employer details updated successfully.";
        header("Location: empmanage.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating employer details: " . $conn->error;
        header("Location: empmanage.php");
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Employer</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Leader Name : <?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER   AVAILABILITY  SYSTEM</P>
        <a href="homeAdmin.php"  class="nav-link active " style="margin-left:50px; color:yellow">Dashbord</a>
        <a href="empmanage.php"  class="nav-link active " style="margin-left:50px; color:yellow">Employer Manage</a>
        <a class="nav-link active "  aria-current="page" href="logout.php" style="margin-left:50px; color:yellow">Logout</a> </nav>

<div class="container mt-5">
    <h2>Update Employer</h2>
    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name="sex"  value="<?php echo $sex; ?>">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>



        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="form-group">
            <label for="tel">Telephone</label>
            <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $tel; ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
