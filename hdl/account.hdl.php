<?php 

include "connect.hdl.php";

// >>>> >>>> Account <<<< <<<<
// View
	$view_account = mysqli_query($db, "SELECT * FROM w_db_account");

// Remove
	if(isset($_GET['del_account_id'])){
		$id = $_GET['del_account_id'];
		mysqli_query($db, "DELETE FROM w_db_account where id=$id");
		header('location: ../w_account.php');
	}

// Approve
	if(isset($_GET['approve_account_id'])){
		$id = $_GET['approve_account_id'];
		$user_id = $_GET['user_id'];
		date_default_timezone_set("Asia/Bangkok");
		$approve_date = date("Y-m-d");
		mysqli_query($db, "UPDATE w_db_account SET status = 1, approve_by = '$user_id', approve_date = '$approve_date' WHERE id=$id");
		header('location: ../w_account.php');
	}


// Unlock 
	if(isset($_GET['unlock_account_id'])){
		$id = $_GET['unlock_account_id'];
		mysqli_query($db, "UPDATE w_db_account SET status = 1 WHERE id=$id");
		header('location: ../w_account.php');
	}
// Lock
	if(isset($_GET['lock_account_id'])){
		$id = $_GET['lock_account_id'];
		mysqli_query($db, "UPDATE w_db_account SET status = 3 WHERE id=$id");
		header('location: ../w_account.php');
	}

// Upgrade
	if(isset($_GET['upgrade_account_id'])){
		$id = $_GET['upgrade_account_id'];
		mysqli_query($db, "UPDATE w_db_account SET role_id = 8 WHERE id=$id");
		header('location: ../w_account.php');
	}
// Downgrade
	if(isset($_GET['downgrade_account_id'])){
		$id = $_GET['downgrade_account_id'];
		mysqli_query($db, "UPDATE w_db_account SET role_id = 1 WHERE id=$id");
		header('location: ../w_account.php');
	}

// Register New User from Inside
	if (isset($_POST['new_user'])) {

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
			header("Location: ../w_account.php?error=emptyfields");
			exit();
		} else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			header("Location: ../w_account.php?error=invaliduid");
			exit();
		} else if($password !== $r_password) {
			header("Location: ../w_account.php?error=passwordcheck");
			exit();
		} else {
			$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO w_db_account (name, username, password, phone_no, role_id, status, create_date, create_by) VALUES ('$name', '$username', '$hashedPwd', '$phone_no', '$role_id', '$status', '$date', '$user_id')" ;
			mysqli_query($db, $query);
			header('location: ../w_account.php');
		} 
	}


// Change password from inside Account page
	if (isset($_POST['change_password'])) {
		require 'connect.hdl.php';
		$id = $_POST['account_id'];
		$password = $_POST['password'];
		$r_password = $_POST['r_password'];

		// change password
		if($password !== $r_password) {
			$id = $_POST['account_id'];
			header("Location: ../w_account.php?error=passwordcheck&change_password=$'.$id.'");
			exit();
		} else {
			$sql = "UPDATE w_db_account SET password = ? WHERE id=$id";
			$stmt = mysqli_stmt_init($db);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../w_account.php?error=sqlerror&seconderror&change_password=$'.$id.'");
				exit();
			} else{
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, "s", $hashedPwd);
				mysqli_stmt_execute($stmt);
				header("Location: ../w_account.php");
				exit();
			}
		}
	}

// Change password from inside Top Right Corner drop down
	if (isset($_POST['change_password2'])) {
		require 'connect.hdl.php';
		$id = $_POST['account_id'];
		$password = $_POST['password'];
		$r_password = $_POST['r_password'];
	
		// change password
		if($password !== $r_password) {
			$id = $_POST['account_id'];
			header("Location: ../w_account.php?error=passwordcheck&change_password=$'.$id.'");
			exit();
		} else {
			$sql = "UPDATE w_db_account SET password = ? WHERE id=$id";
			$stmt = mysqli_stmt_init($db);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../w_account.php?error=sqlerror&seconderror&change_password=$'.$id.'");
				exit();
			} else {
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, "s", $hashedPwd);
				mysqli_stmt_execute($stmt);
				header("Location: ../w_room_main.php");
				exit();
			}
		}
	}

// Change user detail from Inside
	if(isset($_POST['change_detail'])){
		$id = $_POST['account_id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$phone_no = $_POST['phone_no'];

		mysqli_query($db, "UPDATE w_db_account SET name = '$name', username = '$username', phone_no = '$phone_no' WHERE id=$id");
		header('location: ../w_account.php');
	}

// Change user detail from inside Top Right Corner drop down
	if(isset($_POST['change_detail2'])){
		$id = $_POST['account_id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$phone_no = $_POST['phone_no'];

		mysqli_query($db, "UPDATE w_db_account SET name = '$name', username = '$username', phone_no = '$phone_no' WHERE id=$id");
		header('location: ../w_room_main.php');
	}