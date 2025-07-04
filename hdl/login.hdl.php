<?php 
include "connect.hdl.php";

if (isset($_POST['login_submit'])) {

	require 'connect.hdl.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
    $status = 1;

	if (empty($username) || empty($password)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
	} else {
		$sql = "SELECT * FROM w_db_account WHERE username = ? AND status = 1";
		$stmt = mysqli_stmt_init($db);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../w_login.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password, $row['password']);

				if ($pwdCheck == false) {
					header("Location: ../w_login.php?error=wrongpwd");
					exit();
				} else if ($pwdCheck == true) {
					session_start();
					$_SESSION['userid'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['role'] = $row['role_id'];
					$new_date = new DateTime('Asia/Vientiane') ;
					$new_date_f = $new_date->format('Y-m-d');
					// $_SESSION['date'] = $new_date->format('Y-m-d');
					$_SESSION['date'] = $new_date_f;
					header("Location: ../w_room_main.php");
					exit();

				} else {
					header("Location: ../w_login.php?error=wrongpwd");
					exit();
				}
			} else {
				header("Location: ../w_login.php?error=nouser");
				exit();
			}

		}
	}

} else {
	header("Location: ../w_login.php");
	exit();
}