<?php
    session_start();
    require_once "../Config.php";
    require_once "../Functions/DBFunctions.php";
    require_once "../Functions/HelperFunctions.php";

    if (isset($_POST['register'])) {
        if ($_POST['password'] == $_POST['password_confirm']) {
            insert($conn, "users", [
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'is_admin' => 0
            ]);
            $_SESSION['email'] = $_POST['email'];
            header('Location: courses.php');
            exit();
        } else {
            alert("password and confirm password not the same", 0);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../Assets/img/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/login.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../Assets/img/img-01.png" alt="IMG">
				</div>

				<form action="register.php" method="POST" class="login100-form validate-form">
					<span class="login100-form-title">
						Register
					</span>

                    <div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="name" placeholder="Your Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" >
						<input class="input100" type="password" name="password_confirm" placeholder="confirm_Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					
					<div class="container-login100-form-btn">
						<button name= "register" value="register" class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="login.php">
                            Have an account ?
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="../Assets/js/login.js"></script>

</body>
</html>