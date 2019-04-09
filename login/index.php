<?php
	session_start();

	if (isset($_SESSION["loggedin"])) {
		header("Location: /dashboard");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/res/css/login.css">

		<title>UAJ300 - Login</title>
	</head>
	
	<body>
		<div class="loginbox" style="height: 440px; top: 50%;">
		<img src="/res/img/logo.png" class="logo">
			<h1>Login</h1>
			
			<form id="login_form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<p>Email</p>
				<input type="text" name="email" 
                value="<?php echo (isset($_SESSION['Imember']) ? htmlspecialchars($_SESSION['Imember']) : ''); ?>"
                oninput="return validateEmail(this);" oninvalid="return validateEmail(this);" onsubmit="return validatePassword(this);" placeholder='Enter Email' required>
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter Password" autocomplete="email" required>				
				<input type="checkbox" name="remember" value="Remember Me"
					<?php echo (isset($_SESSION['Imember']) ? 'checked' : '') ?>><p2>Remember Me</p2>
				<input type="submit" name="submit" value="Login">
				<a href="/login/forgot">Forgot Password?</a><br>
				<a href="/login/register">Register New Account</a><br>
			</form>
		</div>
	</body>
	
	<script type="text/javascript">	
		function validateEmail(email) {
			if(email.validity.typeMismatch || !checkValidEmail(email.value)) {
				email.setCustomValidity('Please enter a valid email address');
				return true;
			}
			
			email.setCustomValidity('');
			return true;
		}
		
		function checkValidEmail(email) {
			  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			  return re.test(email);
		}
	</script>
	
	<?php
		$email = "";
		$password = "";
		$errors = "";

		require_once('../res/php/dbinfo.php');
		$connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);

		if (!$connection) {
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		$email = strtolower(filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL));
    		$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    		$sql = "SELECT * FROM user_data WHERE email = '$email'";
			$result = mysqli_query($connection, $sql);
    		$user_data = mysqli_fetch_array($result);

    		if(password_verify($password, $user_data['password_hash'])){
        		$_SESSION["user"] = $user_data['user_id'];
				$_SESSION["loggedin"] = True;
				if(isset($_POST['remember'])) {
					$_SESSION["Imember"] = $user_data['email'];
				} else if(isset($_SESSION["Imember"])) {
					unset($_SESSION["Imember"]);		
				}
        		header("Location: /dashboard");
    		} else
       			echo "Email password combination does not exist in database";
		}
	?>

</html>
