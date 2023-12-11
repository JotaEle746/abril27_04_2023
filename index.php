<?php
	require_once('includes/db.php');

	if (isset($mysqli, $_POST['submit'])) {
		$username = mysqli_real_escape_string($mysqli, $_POST['username']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		$password = md5($password);
		$query    = mysqli_query($mysqli, "SELECT username, password, type, permission FROM users");
		while ($row = mysqli_fetch_array($query)) {
			$db_username = $row["username"];
			$db_password = $row["password"];
			$db_type     = $row["type"];
			$db_per      = $row["permission"];

			if ($username == $db_username && $password == $db_password) {
				session_start();
				$_SESSION["username"] = $db_username;
				$_SESSION["type"] = $db_type;
				$_SESSION["permission"] = $db_per;
				$_SESSION["name"] = $db_name;
				$_SESSION["surname"] = $db_surname;

				header("Location: admin/dashboard.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	<title>Iniciar sesión</title>
</head>

<body>
	<div class="container-login100">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" method="post" action="index.php">
				<span class="login100-form-title p-b-37">
					Login
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username ">
					<input class="input100" type="text" name="username" placeholder="username ">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
					<input class="input100" type="password" name="password" placeholder="password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="submit">
						Iniciar sesión
					</button>
				</div>
			</form>


		</div>
	</div>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
