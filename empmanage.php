<?php session_start(); include ("db_connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employer Management</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Leader Name : <?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER   AVAILABILITY  SYSTEM</P>
        <a href="homeAdmin.php"  class="nav-link active " style="margin-left:50px; color:yellow">Dashbord</a>
        <a class="nav-link active "  aria-current="page" href="logout.php" style="margin-left:50px; color:yellow">Logout</a> </nav>

<div class="container mt-5">
  <h2>Employer Details</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Username</th>
        <th>Sex</th>
        <th>Address</th>
        <th>Telephone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $sql = "SELECT * FROM employer";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['username'] . "</td>";
              echo "<td>" . $row['sex'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['tel'] . "</td>";
              echo "<td>";
              echo "<a href='update.php?id=".$row['id']."' class='btn btn-danger btn-sm ml-1'>Update</a>  ";
              echo "<a href='delete.php?id=".$row['id']."&username=".$row['username']."' class='btn btn-primary btn-sm'>Delete</a>";
              echo "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='5'>No employers found</td></tr>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
