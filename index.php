<?php 
require_once 'php_action/db_connect.php';

// server should keep session data for AT LEAST 1 hour
//ini_set('session.gc_maxlifetime', 32400);

// each client should remember their session id for EXACTLY 1 hour
//session_set_cookie_params(32400);

session_start();

if(isset($_SESSION['userId'])) {
	header('location: http://www.anekapetindo.com/inventory/dashboard.php');
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;

				header('location: http://www.anekapetindo.com/inventory/dashboard.php');
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username does't exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System Caesar Jaco</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/styles/style.min.css">
</head>
<body>
<div id="single-wrapper">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm" class="frm-single">
	<fieldset>
		<div class="inside">
			<div class="title"><strong>Caesar Jaco</strong><br>Stock Management System</div>
			<div class="frm-title">Login</div>
			<div class="messages">
				<?php if($errors) {
					foreach ($errors as $key => $value) {
					echo '	<div class="alert alert-warning" role="alert">
							<i class="glyphicon glyphicon-exclamation-sign"></i>
							'.$value.'</div>';										
					}
				} ?>
			</div>
			<div class="frm-input"><input type="text" id="username" name="username" placeholder="Username" class="frm-inp" autocomplete="off"><i class="fa fa-user frm-ico"></i></div>
			<div class="frm-input"><input type="password" id="password" name="password" placeholder="Password" class="frm-inp" autocomplete="off"><i class="fa fa-lock frm-ico"></i></div>
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			<div class="frm-footer">Caesar Jaco © 2017.</div>
		</div>
	</fieldset>
	</form>
</div>
</body>
</html>