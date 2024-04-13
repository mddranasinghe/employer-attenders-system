<?php  session_start();include ("../db_connection.php");?>
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
            background-color: #e0dbdf;
        }

        .container {
            margin-top: 50px;
        }

        .left-container, .right-container {
            width: 100%;
            margin-top: 20px;
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
            text-align: center;
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

        .li {
            background-color: white;
            text-align: center;
            box-shadow: 0.5px 0.5px 3px 0.5px gray;
            padding: 10px;
            border-radius: 10px;
            margin-left:4%;
          width:90%
        }

        .table {
            box-shadow: 0.5px 0.5px 3px 0.5px gray;
            padding: 10px;
            border-radius: 10px;
            background-color: gray;
            text-align: center;
            color: white;
         margin-left:4%;
          width:90%

        }

        .btn {
            background-color: green;
            margin-left: auto;
            padding-left: 20px;
            padding-right: 20px;
            color: white;
        }

        @media screen and (min-width: 974px) {
            .left-container, .right-container {
                width: 50%;
                float: left;
            }
        }

       
            #employer_name 
            {
                width:450px;
            }
         #availability_date
            {
                width:450px;
            }
            @media only screen and (max-width: 1200px) {

                #employer_name 
            {
                width:350px;
            }
         #availability_date
            {
                width:350px;
            }

            }
            
    
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Leader Name : <?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER   AVAILABILITY  SYSTEM</P>
        <a href="reg.php"  class="nav-link active " style="margin-left:50px; color:yellow">Employer Registation</a>
        <a class="nav-link active "  aria-current="page" href="../logout.php" style="margin-left:50px; color:yellow">Logout</a> </nav>

    <div class="left-container">
        <div class="container">
            <div class="col-md-6">
                <form method="GET">
                    <div class="form-group">
                        <label for="employer_name">Enter Employer Name:</label>
                        <table>
                            <tr>
                                <td>
                                    <input type="text" id="employer_name" name="employer_name" class="form-control"
                                     required>
                                </td>
                                <td>
                                    <button type="submit" class="btn">Search</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <tr>
                <td>available Dates</td>
            <tr>
        </table>
        <?php
       
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employer_name'])) {
            $employer_name = $_GET['employer_name'];
            $availability_query = "SELECT date FROM availability WHERE username = '$employer_name'";
            $availability_result = mysqli_query($conn, $availability_query);
            if (mysqli_num_rows($availability_result) > 0) {
                echo "<div class='result-container'>";
                echo "<ul class='result-list'>";
                while ($row = mysqli_fetch_assoc($availability_result)) {
                    echo "<li class='li'>" . $row["date"] . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='result-container'>";
                echo "<p class='alert alert-warning'>No availability found for $employer_name</p>";
                echo "</div>";
            }
            
            mysqli_close($conn);
        }
        ?>
    </div>
    <div class="right-container">
        <div class="container">
            <div class="col-md-6">
                <form method="GET">
                    <div class="form-group">
                        <label for="availability_date">Enter Date (YYYY-MM-DD):</label>
                        <table>
                            <tr>
                                <td>
                                    <input type="date" id="availability_date" name="availability_date" class="form-control"
                                     required>
                                </td>
                                <td>
                                    <button type="submit" class="btn">Search</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <tr>
                <td>available Employers</td>
            <tr>
        </table>
        <?php
    
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['availability_date'])) {
            
            $availability_date = $_GET['availability_date'];
            $availability_query = "SELECT username FROM availability WHERE date = '$availability_date'";
            $availability_result = mysqli_query($conn, $availability_query);
            if (mysqli_num_rows($availability_result) > 0) {
           
                echo "<div class='result-container'>";
                echo "<ul class='result-list'>";
                while ($row = mysqli_fetch_assoc($availability_result)) {
                    echo "<li class='li'>" . $row["username"] . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='result-container'>";
                echo "<p class='alert alert-warning'>No employers available on $availability_date</p>";
                echo "</div>";
            }
          
            mysqli_close($conn);
        }
        ?>
    </div>
</div>
</body>
</html>
