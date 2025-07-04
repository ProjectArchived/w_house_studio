<?php 

session_start();

include "connect.hdl.php";

// Get value pass from login file
if (isset($_POST['new_user'])) {

	require 'connect.hdl.php';

	$user_id = $_POST['user_id'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$r_password = $_POST['r_password'];
    $phone_no = $_POST['phone_no'];
	$role_id = 1;
    $status = 2;
	$date = date("Y-m-d");

	// check if cell is empty
	if(empty($name) || empty($username) || empty($password) || empty($r_password) || empty($phone_no)){
		header("Location: ../w_register.php?error=emptyfields");
		exit();
	} else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../w_register.php?error=invaliduid");
		exit();
	} else if($password !== $r_password) {
		header("Location: ../w_register.php?error=passwordcheck");
		exit();
	} else {
		$sql = "SELECT username FROM w_db_account WHERE username=?";
		$stmt = mysqli_stmt_init($db);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../w_register.php?error=sqlerror");
			exit();
		} else {
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if ($resultCheck > 0) {
			header("Location: ../w_register.php?error=usertaken");
			exit();
		} else {
			$sql = "INSERT INTO w_db_accountunt (name, username, password, phone_no, role_id, status, create_date, create_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_stmt_init($db);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../w_register.php?error=sqlerror&seconderror");
			exit();
		} else{
			$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

			mysqli_stmt_bind_param($stmt, "ssssssss", $name, $username, $hashedPwd , $phone_no, $role_id, $status, $date, $user_id);
			mysqli_stmt_execute($stmt);
			header("Location: ../w_login.php");
			exit();
		}
		}
	}

	} 

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {
	header("Location: ../w_register.php");
	exit();
}

