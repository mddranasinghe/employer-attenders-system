
<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Availability Viewer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:  #e0dbdf;
        }

        .container {
            margin-top: 50px;
        }

        .search-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .result-container {
            margin-top: 30px;
        }

        .result-heading {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .result-list {
            list-style-type: none;
            padding-left: 0;
        }

        .result-list li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Leader Name :-<?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER  AVAILABILITY  CHECKING  SYSTEM</P>
        <a class="nav-link active " id="main-nav-a" aria-current="page" href="../logout.php" style="margin-left:50px; color:yellow">LOGOUT</a>

    </nav>

    <div class="container">
        <h2 class="text-center mb-4">Search Employer Availability</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="search-form" method="GET">
                    <div class="form-group">
                        <label for="employer_name">Enter Employer Name:</label>
                        <input type="text" id="employer_name" name="employer_name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:#4b0150; color:white">Search</button>
                </form>
            </div>
        </div>

        <?php
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employer_name'])) {
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "employer_attenders_system";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch availability for the specified employer
            $employer_name = $_GET['employer_name'];
            $availability_query = "SELECT date FROM availability WHERE username = '$employer_name'";
            $availability_result = mysqli_query($conn, $availability_query);

            if (mysqli_num_rows($availability_result) > 0) {
                // Display availability
                echo "<div class='result-container'>";
                echo "<h3 class='result-heading'>Availability for $employer_name:</h3>";
                echo "<ul class='result-list'>";
                while ($row = mysqli_fetch_assoc($availability_result)) {
                    echo "<li>" . $row["date"] . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='result-container'>";
                echo "<p>No availability found for $employer_name</p>";
                echo "</div>";
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
