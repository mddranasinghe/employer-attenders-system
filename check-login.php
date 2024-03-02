<?php  

//login login 
session_start();
include "db_connection.php";

if(isset($_POST['submit'])){

	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$role=mysqli_real_escape_string($conn,$_POST['role']);
	

	if ($role == 'Employer') {
		$sql = "SELECT * FROM employer WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
	
		// Check if any rows were returned by the query
		if (mysqli_num_rows($result) > 0) {
			$_SESSION['username'] = $username;
			header("Location: employer/home.php");
		} else {
			echo "Failed to login.";
		}
	}
  else if ($role == 'Leader'){ 

	$sql = "SELECT * FROM leader WHERE username='$username' AND password='$password'";
	$result1= mysqli_query($conn, $sql);
	var_dump($result1);

	if(mysqli_num_rows($result1)>0){
		
		$_SESSION['username'] =$username ;
		header("Location: leader/home.php");
	
	}else{
		echo "Failed to login.";
	}
	
  } 
 
}
?>

