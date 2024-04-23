<?php session_start(); include ("db_connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
 
            body {
            font-family: Arial, sans-serif;
            background-color: #e0dbdf;
        }
        

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Leader Name : <?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER   AVAILABILITY  SYSTEM</P>
        <a href="homeAdmin.php"  class="nav-link active " style="margin-left:50px; color:yellow">Dashbord</a>
        <a class="nav-link active "  aria-current="page" href="logout.php" style="margin-left:50px; color:yellow">Logout</a> </nav>
<div class="container">
    <h2 class="mb-4">Employer Registration Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="tel">Telephone:</label>
            <input type="tel" class="form-control" id="tel" name="tel" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-submit" style="background-color:green; align:center">Submit</button>
    </form>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];


  
    $sql = "INSERT INTO employer (username, sex, address, tel, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $username, $sex, $address, $tel, $password);


    if ($stmt->execute()) {
        echo "<p class='alert alert-success' style='text-align:center'>New record inserted successfully</p>";

    } else {
        echo "<p class='alert alert-danger' style='text-align:center'>New record inserted failed!</p>";

    }


    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
